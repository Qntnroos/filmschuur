<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{

    /**
     * @Route("/reservering", name="reservering")
     */

    public function generate_pdf(Request $request){
       
        return $this->render('components/ticketreservering.html.twig');
    }
}