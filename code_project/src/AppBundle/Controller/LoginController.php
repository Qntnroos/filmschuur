<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\utils\database;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function PasswordCheck(Request $request, Session $session){
        $session = new Session();
        $session->start();
        if($request->get('RegisterFormEmail') && (empty($request->get('RegisterFormEmail')))){
            $email1Err = "E-mail is vereist&nbsp;&#x274C;";
            $session->remove('email1');
            return $email1Err;
        }
        return $this->render('login/login.html.twig');
    }
}
