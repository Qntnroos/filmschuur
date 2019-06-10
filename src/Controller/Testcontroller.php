<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class Testcontroller extends AbstractController
{
    /**
     * @Route("/resetmail", name="resetmail")
     */
    public function route_to_resetPassword_page(Request $request){
    
        return $this->render('login/resetmail.html.twig');
    }
}

