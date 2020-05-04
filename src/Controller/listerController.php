<?php


namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\component\HttpFoundation\Response ;
use Twig\Environment;

class listerController extends AbstractController
{


    public function index(ProductRepository $productRepository):Response
    {

        return $this->render('/lister.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }






}
