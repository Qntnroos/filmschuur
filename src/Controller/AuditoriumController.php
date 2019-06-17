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

class AuditoriumController extends AbstractController
{
    public function Helpfunctions (Request $request, CsrfTokenManagerInterface $csrfTokenManager){

        $this->csrfTokenManager = $csrfTokenManager;
       
        if ($request->isMethod('post')){
            $csrftoken= $request->request->get('_csrf_token');
            if (!$this->isCsrfTokenValid('authenticate', $csrftoken)) 
            {
                return $this->redirectToRoute('error403');
            }

            $getnormalAmount= $request->request->get('amount');
            $getreducedAmount= $request->request->get('reducedAmount');
            $parking= $request->request->get('parking');     
            $session = $request->getSession();
            $session->set('normalAmount', $getnormalAmount);
            $session->set('reducedAmount', $getreducedAmount);
            $session->set('parking', $parking);
            $filmID = $session->get('filmId');
            $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

            $req = $client->request(
                'GET',
                'collections/get/filmposters',
                ['headers' => ['Cockpit-Token' => '9e5c1c03342c45edccdfb83095f054'],
                    'json' => ['filter' => [ 'Id' => $filmID]]
                ]
            );
            $getAuditName = $session->get('auditname');
            $filmTitle = $session->get('filmTitle');
            $showDateTime = $session->get('showDateTime');
            $auditoriumname = $session->get('auditname');
            $normalAmount =$session->get('normalAmount');
            $reducedAmount =$session->get('reducedAmount');
            $counttotalamount = $normalAmount + $reducedAmount;
            $session->set('totalAmount', $counttotalamount);
            $totalAmount = $session->get('totalAmount');
            $answer = json_decode($req->getBody()->getContents());
            $val = $answer->entries[0]->Image->path;
            return ['filmTitle' => $filmTitle, 'moviePoster' => $val, 'showDateTime' => $showDateTime,'auditorium' => $auditoriumname,'totalAmount'=>$totalAmount ];
        }
    }


    /**
     * @Route("/auditorium/Edison", name="Edison")
     */
    public function Edison(Request $request,CsrfTokenManagerInterface $csrfTokenManager)
    {
        $variabels = $this->Helpfunctions($request, $csrfTokenManager); 
        return $this->render('pages/edison.html.twig', $variabels);
    }
    /**
     * @Route("/auditorium/Lumière", name="Lumière")
     */
    public function Lumière(Request $request,CsrfTokenManagerInterface $csrfTokenManager)
    {
        $variabels = $this->Helpfunctions($request, $csrfTokenManager); 
        return $this->render('pages/lumiere.html.twig',$variabels);
    }
    /**
     * @Route("/auditorium/Muybridge", name="Muybridge")
     */
    public function Muybridge(Request $request,CsrfTokenManagerInterface $csrfTokenManager)
    {
        $variabels = $this->Helpfunctions($request, $csrfTokenManager); 
        return $this->render('pages/muybridge.html.twig',$variabels);
    }
}
