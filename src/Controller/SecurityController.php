<?php
/**
 * Security Controller
 */
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;

use App\Util\CSSClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends Controller
{
    /**
     * Stores an encoder interface to encode
     * user password when signing up.
     *
     * @var UserPasswordEncoderInterface
     */
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
     * Displays login index allowing users to authenticate
     * the current session.
     *
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authUtils)
    {
        return $this->render(
            'security/index.html.twig',
            [
                'class' => CSSClass::input(),
                'error' => $authUtils->getLastAuthenticationError(),
                'last_username' => $authUtils->getLastUsername()
            ]
        );
    }

    /**
     * Function that allows users to end
     * the current logged in session with additional features.
     *
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     *
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request, AuthenticationUtils $authUtils)
    {

    }

    /**
     * Allows users to create an account.
     *
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/signup", name="signup")
     * @Method({"GET", "POST"})
     */
    public function signup(Request $request, AuthenticationUtils $authUtils)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
            return $this->redirectToRoute('home');

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $form->getData()->getPassword()));
            $user->setRoles(['ROLE_USER']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('notice', 'Account successfully created.');

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/signup.html.twig',
            [
                'form' => $form->createView(),
                'error' => $authUtils->getLastAuthenticationError(),
                'last_username' => $authUtils->getLastUsername()
            ]
        );
    }
}
