<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class InformationController extends Controller
{
    /**
     * @Route("/information", name="information")
     */
    public function route_to_information_page(Request $request){
    
        return $this->render('pages/information.html.twig');
    }
}