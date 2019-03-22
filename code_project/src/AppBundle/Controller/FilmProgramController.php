<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\utils\database;

class FilmProgramController extends Controller
{
    /**
     * @Route("/programma/", name="programma")
     */
    public function renderFilm(Request $request)
    {
        return $this->render('pages/overview.html.twig');
    }
}
