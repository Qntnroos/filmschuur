<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\utils\database;

class TicketOrder extends AbstractController
{
    /**
     * @Route("/tickets/order", name="ticketsorder")
     */
    public function renderFilm(Request $request)
    {
        return $this->render('pages/ticketorder.html.twig');
    }
}
