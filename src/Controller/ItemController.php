<?php
/**
 * Item Controller
 */
namespace App\Controller;

use App\Entity\Item;
use App\Entity\Review;
use App\Form\ItemType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ItemController
 * @package App\Controller
 *
 * @Route("/items", name="item_")
 */
class ItemController extends Controller
{
    /**
     * @return Response
     *
     * @Route("/", name="index")
     * @Method({"GET", "POST"})
     */
    public function index()
    {
        $items = $this->getDoctrine()
            ->getRepository(Item::class)
            ->findAll();

        return $this->render('item/index.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     *
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function new(Request $request)
    {
        $item = new Item();

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item->setUsername($this->getUser()->getUsername());

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            $this->addFlash('notice', 'A new item has been created.');

            return $this->redirectToRoute('item_show', ['id' => $item->getId()]);
        }

        return $this->render('item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView()
        ]);
    }

    /**
     * @return Response
     *
     * @Route("/my_items", name="my_items")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function myItems()
    {
        $items = $this->getDoctrine()
            ->getRepository(Item::class)
            ->findBy([ 'username' => $this->getUser()->getUsername()]);

        return $this->render(
            'item/myitems.html.twig',
            [
                'items' => $items
            ]
        );
    }

    /**
     * @param Item $item
     * @return Response
     *
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Item $item)
    {
        $template = 'item/show.html.twig';
        if (!$item)
            $template = 'errors/exception.html.twig';

        return $this->render($template, [
            'item' => $item,
            'reviews' => $this->getDoctrine()
                ->getRepository(Review::class)
                ->findBy(['item' => $item])
        ]);
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse|Response
     *
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function edit(Request $request, Item $item)
    {
        if ($this->getUser()->getUsername() != $item->getUsername())
        {
            $this->addFlash('notice', 'You cannot edit this item.');
            return $this->redirectToRoute('item_show', ['id' => $item->getId()]);
        }

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', 'Your changes were saved!');

            return $this->redirectToRoute('item_show', ['id' => $item->getId()]);
        }

        $template = 'item/edit.html.twig';
        $args = [
            'item' => $item,
            'form' => $form->createView()
        ];

        if (!$item)
            $template = 'errors/exception.html.twig';

        return $this->render($template, $args);
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     *
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_USER')")
     */
    public function delete(Request $request, Item $item)
    {
        if (!$this->isCsrfTokenValid('delete' . $item->getId(), $request->request->get('_token')))
            return $this->redirectToRoute('item_index');

        $em = $this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();

        return $this->redirectToRoute('item_index');
    }
}