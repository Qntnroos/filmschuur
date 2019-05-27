<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\database;
use GuzzleHttp\Client;

class FilmController extends AbstractController
{
    /**
     * @Route("/filmrender", name="filmm")
     */
    public function renderFilm(Request $request)
    {
        $db = new database();
        $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

        $homeDetails = $db->getHomepageDetails();
        $movieGenre = $db->getMoviesByGenres();
        $resHome= [];
        foreach ($homeDetails as $value){
            $id = $value['movieID'];
            $req = $client->request(
                'GET',
                'collections/get/filmposters',
                ['headers' => ['Cockpit-Token' => '9e5c1c03342c45edccdfb83095f054'],
                    'json' => ['filter' => [ 'Id' => $id]]
                ]
            );
            $answer = json_decode($req->getBody()->getContents());
            $val = $answer->entries[0]->Image->path;
            $value['poster'] = $val;
            array_push($resHome, $value);
        }
        $resGenre= [];
        foreach ($movieGenre as $genreValue){
            $id = $genreValue['filmID'];
            $req = $client->request(
                'GET',
                'collections/get/filmposters',
                ['headers' => ['Cockpit-Token' => '9e5c1c03342c45edccdfb83095f054'],
                    'json' => ['filter' => [ 'Id' => $id]]
                ]
            );
            $answer = json_decode($req->getBody()->getContents());
            $genreval = $answer->entries[0]->Image->path;
            $genreValue['poster'] = $genreval;
            array_push($resGenre, $genreValue);
        }
        $variables = ['res' => $resHome, 'film' => $resGenre];
        $html = $this->renderView('components/film.html.twig', $variables);
        return $this->json([
            'data' => $html
        ]);
    }
}
