<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\utils\database;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function PasswordCheck(Request $request){
        // $session = $request->getSession();
        $email1Err = '';
        $test = [$request->get('RegisterFormEmail')];
        if(empty($request->get('RegisterFormEmail'))){
            $email1Err = "E-mail is vereist&nbsp;&#x274C;";
        }
        return $this->render('login/login.html.twig', ['error' => $email1Err]);
    }
}
