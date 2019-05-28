<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class error403Controller extends Controller
{
    /**
     * @Route("/error403", name="error403")
     */
    public function route_to_error403_page(Request $request){

        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }
}