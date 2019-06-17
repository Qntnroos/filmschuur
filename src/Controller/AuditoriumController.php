<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\database;

class AuditoriumController extends AbstractController
{
    /**
     * @Route("/auditorium/Edison", name="Edison")
     */
    public function Edison(Request $request)
    {
        return $this->render('pages/edison.html.twig');
    }
    /**
     * @Route("/auditorium/Lumière", name="Lumière")
     */
    public function Lumière(Request $request)
    {
        return $this->render('pages/lumiere.html.twig');
    }
    /**
     * @Route("/auditorium/Muybridge", name="Muybridge")
     */
    public function Muybridge(Request $request)
    {
        return $this->render('pages/muybridge.html.twig');
    }
}
