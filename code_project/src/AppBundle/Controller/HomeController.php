<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/index/", name="index")
     */
    public function renderHome(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/home.html.twig');
    }
}
