<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\utils\database;
use GuzzleHttp\Client;

class FilmProgramController extends Controller
{
    /**
     * @Route("/programma", name="programma")
     */
    public function renderFilm(Request $request)
    {
        $db = new database();
        $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

        $homeDetails = $db->getHomepageDetails();
        $genres = $db->getGenres();
        $dates = $db->getOverviewDates();
        $res= array();
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
            array_push($res, $value);
        }

        return $this->render('pages/overview.html.twig', ['res' => $res,
            'genres' => $genres,'dates'=> $dates]);
    }
}
