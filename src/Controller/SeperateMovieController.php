<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\database;

class SeperateMovieController extends AbstractController
{
    /**
     * @Route("/film/{id}", name="film")
     */
    public function renderFilm(Request $request, $id)
    {
        $db = new database();
        $movieDetails = $db->getMovieDetails($id);
        $movieTitle = $movieDetails[0]["movie_title"]; 
        $movieDates = $db->getMovieDates($id);
        $directorInfoArray= array();
        $session = $request->getSession();
        $session->set('filmId', $id);
        $session->set('filmTitle', $movieTitle);

        foreach ($movieDetails as $movieDetail){
            $director = $movieDetail['directors'];
            $directorInfo = $db->getDirectorInfo($director);
            array_push($directorInfoArray,$directorInfo);
        }
        $val = ['info' => $movieDetails, 'dates' => $movieDates, 'directorInfo' => $directorInfoArray];
        // replace this example code with whatever you need
        return $this->render('pages/seperate-film.html.twig', $val);
    }
}
