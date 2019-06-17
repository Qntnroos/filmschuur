<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\utils\database;
use GuzzleHttp\Client;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class TicketsOrderController extends AbstractController
{
    /**
     * @Route("/ticketsorder", name="tickets_order")
     */

    public function ticketsOrders(Request $request, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $this->csrfTokenManager = $csrfTokenManager;
       
        if ($request->isMethod('post')){
            $csrftoken= $request->request->get('_csrf_token');
            if (!$this->isCsrfTokenValid('authenticate', $csrftoken)) 
            {
                return $this->redirectToRoute('error403');
            }
            $showDateTime= $request->request->get('datum');
            $session = $request->getSession();
            $session->set('showDateTime', $showDateTime);
           

            $session = $request->getSession();
            $filmID = $session->get('filmId');
            $filmTitle = $session->get('filmTitle');
            $showDateTime = $session->get('showDateTime');

            $db = new database();
            $playtime = $db->getAuditoriumInfo($filmID, $showDateTime);
            $auditoriumname = $playtime["auditorium_name"];
            $IdForAuditName = $db->getIdForAudit($auditoriumname);
            $session->set('auditname', $auditoriumname);
            $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

                $req = $client->request(
                    'GET',
                    'collections/get/filmposters',
                    ['headers' => ['Cockpit-Token' => '9e5c1c03342c45edccdfb83095f054'],
                        'json' => ['filter' => [ 'Id' => $filmID]]
                    ]
                );
                $getAuditName = $session->get('auditname');
                $answer = json_decode($req->getBody()->getContents());
                $val = $answer->entries[0]->Image->path;
            return $this->render('pages/ticketorder.html.twig', array(
                'filmTitle' => $filmTitle, 'moviePoster' => $val, 'showDateTime' => $showDateTime, 'auditorium' => $auditoriumname,'getAuditName'=> $getAuditName));
            }

    }
}
