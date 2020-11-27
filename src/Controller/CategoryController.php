<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category.index")
     */
    public function index(CategoryRepository $repo): Response
    {
        $categories = $repo->findAllVisible();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category.show")
     */
    public function showCatprod(Category $category, ProductRepository $repoProd):Response
    {
        $products = $repoProd->getByID($category->getId());
        return $this->render('category/catprod.html.twig', [
            'products' => $products,
        ]);
    }
}
