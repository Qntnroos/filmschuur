<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\utils\database;
use GuzzleHttp\Client;

class TicketOrderController extends AbstractController
{
    /**
     * @Route("/tickets/order", name="ticket/order")
     */
    public function ticketsOrders(Request $request)
    {

       /*  dd($request->request->get('datum')); */

        $session = $request->getSession();
        $filmID = $session->get('filmId');
        $filmTitle = $session->get('filmTitle');
        $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

            $req = $client->request(
                'GET',
                'collections/get/filmposters',
                ['headers' => ['Cockpit-Token' => '9e5c1c03342c45edccdfb83095f054'],
                    'json' => ['filter' => [ 'Id' => $filmID]]
                ]
            );
            $answer = json_decode($req->getBody()->getContents());
            $val = $answer->entries[0]->Image->path;
        
        return $this->render('pages/ticketorder.html.twig', array(
            'filmTitle' => $filmTitle, 'moviePoster' => $val));
    }
}
