<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlgemeneVoorwaardenController extends Controller
{
    /**
     * @Route("/algemene_voorwaarden", name="Algemene Voorwaarden")
     */
    public function route_to_algemene_voorwaarden_page(Request $request)
    {
    
        return $this->render('pages/algemene_voorwaarden.html.twig');
    }
}