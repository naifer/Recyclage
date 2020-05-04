<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\component\HttpFoundation\Response ;
use Twig\Environment;

class acceuilController extends AbstractController
{


    public function index():Response
    {
        return $this->render('acceuil.html.twig') ;
    }






}
