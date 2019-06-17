<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\database;

class AuditoriumController extends AbstractController
{
    /**
     * @Route("/auditorium/{auditoriumId}", name="auditorium")
     */
    public function renderFilm(Request $request, $auditoriumId)
    {
        $db = new database();
        $values = $db->getSeats($auditoriumId);
        return $this->render('pages/seats.html.twig', ["values" => $values]);
    }
}
