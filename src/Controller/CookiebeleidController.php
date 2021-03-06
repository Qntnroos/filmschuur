<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class CookiebeleidController extends AbstractController
{
    /**
     * @Route("/cookiebeleid", name="cookiebeleid")
     */
    public function route_to_cookiebeleid_page(Request $request){
    
        return $this->render('pages/cookiebeleid.html.twig');
    }
}