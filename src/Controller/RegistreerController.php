<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class RegistreerController extends Controller
{
    /**
     * @Route("/registreer", name="registreer")
     */
    public function route_to_registration_page(Request $request){
        
        return $this->render('login/registreer.html.twig');
    }
}
