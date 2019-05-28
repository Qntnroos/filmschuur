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
       
        // Configure Dompdf according to your needs
        $pdfoptions = new Options();
        $pdfoptions->set('defaultFont', 'Roboto');
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfoptions);
         // Retrieve the HTML generated in our twig file
        
        $html = $this->renderView('components/ticketreservering.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);       
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}