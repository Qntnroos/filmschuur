<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\utils\database;

class SeperateMovieController extends Controller
{
    /**
     * @Route("/film", name="film")
     */
    public function renderFilm(Request $request)
    {
        $db = new database();
        $values = $db-> getMovieDetails();
        $val = ['info' => $values];
        // replace this example code with whatever you need
        return $this->render('pages/seperate-film.html.twig', $val);
    }
}
