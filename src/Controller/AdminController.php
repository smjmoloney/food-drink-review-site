<?php
/**
 * Admin Controller
 */
namespace App\Controller;

use App\Entity\User;
use App\Form\UserTypeAdmin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 * @package App\Controller
 *
 * @Route("/admin", name="admin_")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{
    private $encoder;

    /**
     * SecurityController constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @return Response
     *
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/new", name="new")
     */
    public function new(Request $request, AuthenticationUtils $authUtils)
    {
        $user = new User();

        $form = $this->createForm(UserTypeAdmin::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $form->getData()->getPassword()));
            $user->setRoles($form->getData()->getRoles());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('notice', 'Account successfully created.');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render(
            'admin/new.html.twig',
            [
                'error' => $authUtils->getLastAuthenticationError(),
                'last_username' => $authUtils->getLastUsername(),
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @return Response
     *
     * @Route("/users", name="users")
     */
    public function allUsers()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/users.html.twig', ['users' => $users]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Request $request, User $user)
    {
        $form = $this->createForm(UserTypeAdmin::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $form->getData()->getPassword()));
            $user->setRoles($form->getData()->getRoles());

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Account successfully created.');

            if (!$user->isAdmin())
                return $this->redirectToRoute('home');

            return $this->redirectToRoute('admin_index');
        }

        $template = 'admin/edit.html.twig';

        if (!$user)
            $template = 'errors/exception.html.twig';

        return $this->render($template, [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/{id}/delete", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, User $user)
    {
        if (!$this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token')))
            return $this->redirectToRoute('home');

        $this->get('security.token_storage')->setToken(null);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_index');
    }
}
