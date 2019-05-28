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
        $movieDates = $db->getMovieDates($id);
        $directorInfoArray= array();
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
