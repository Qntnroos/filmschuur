<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class HtmlToPdfController extends Controller
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function pdfAction()
    {
        $pageUrl = $this->generateUrl('ticket_id', array("id" => 1), true); // use absolute path!

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutput('http://localhost:8001' . $pageUrl),
            'ticket.pdf'
        );
    }
    
    /**
     * @Route("/ticket/generate/{id}", name="ticket_id")
     */
    public function generateTicketId($Tid=1)
    {
        return $this->render('components/ticketreservering.html.twig');
        
    }
    

}
