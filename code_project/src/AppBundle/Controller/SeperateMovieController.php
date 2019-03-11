<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SeperateMovieController extends Controller
{
    /**
     * @Route("/film", name="film")
     */
    public function renderFilm(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/seperate-film.html.twig');
    }
}
