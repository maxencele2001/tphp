<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product.index")
     */
    public function index(ProductRepository $repo): Response
    {
        $products = $repo->findLatest();
        return $this->render('product/index.html.twig', [
            'products'=>$products,
            'title'=>'Page D\'accueil'
        ]);
    }

    /**
     * @Route("/product/all", name="product.visible")
     */
    public function allProducts(ProductRepository $repo): Response
    {
        $products = $repo->findAllVisible();
        return $this->render('product/index.html.twig', [
            'products'=>$products,
            'title'=>'Tous les produits'
        ]);
    }

    /**
     * @Route("/product/promo", name="product.promo")
     */
    public function allPromo(ProductRepository $repo): Response
    {
        $products = $repo->findPromo();
        return $this->render('product/index.html.twig', [
            'products'=>$products,
            'title'=>'Toutes les promos'
        ]);
    }

    /**
     * @Route("/product/{id}", name="product.show")
     */
    public function showOne(Product $product): Response
    {
        return $this->render('product/product.html.twig', [
            'product'=>$product,
        ]);
    }
}
