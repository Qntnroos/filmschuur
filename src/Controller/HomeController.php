<?php

namespace App\Controller;

use App\utils\database;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function renderHome(Request $request)
    {
        $db = new database();
        $client = new Client(['base_uri' => 'http://fullstacksyntra.be/cockpitdfs/api/', 'timeout' => 2.0, ]);

        $values = $db->getHomepageDetails();
        $res= array();
        foreach ($values as $value){
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


        return $this->render('pages/home.html.twig', ['res' => $res]);
    }
}
