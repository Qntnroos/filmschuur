<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\utils\database;
use GuzzleHttp\Client;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends AbstractController
{

    /**
     * @Route("/reservering", name="reservering")
     */

    public function generate_pdf(Request $request){
        $session = $request->getSession();
        $filmTitle = $session->get('filmTitle');
        $showDateTime = $session->get('showDateTime');
        $auditoriumname = $session->get('auditname');
        $normalAmount =$session->get('normalAmount');
        $reducedAmount =$session->get('reducedAmount');
        $totalAmount = $session->get('totalAmount');
        $parking = $session->get('parking');
        $email = $session->get('_security.last_username');
        $totalPrice = $normalAmount* 9.5 + $reducedAmount * 7.5;
        if($parking != 0){
            $totalPrice += 2.5;
        }
        $splitdate = explode(" ", $showDateTime);
        return $this->render('components/ticketreservering.html.twig',['totalprice'=> $totalPrice,'filmTitle' => $filmTitle, 'showDateTime' => $splitdate,'auditorium' => $auditoriumname,'totalAmount'=>$totalAmount, 'parking' => $parking, 'email' => $email ]);
    }
}