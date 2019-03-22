<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\utils\database;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function PasswordCheck(Request $request){
        $email1Err = '';
        $test = [$request->get('RegisterFormEmail')];
        if(empty($request->get('RegisterFormEmail'))){
            $email1Err = "E-mail is vereist&nbsp;&#x274C;";
            $session->remove('email1');
        }
        return $this->render('login/login.html.twig', ['error' => $email1Err]);
    }
}
