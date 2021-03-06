<?php
/**
 * Default Controller
 */
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Functions allow navigation of default features.
 *
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Displays the index page of default features.
     *
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
