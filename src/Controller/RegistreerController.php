<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class RegistreerController extends AbstractController
{
    /**
     * @Route("/registreer", name="registreer")
     */
    public function route_to_registration_page(Request $request){
        
        return $this->render('login/registreer.html.twig');
    }
}
