<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('catalogue', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'all_list')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        // find all products
        $products = $productRepository->findBy([], ['id' => 'ASC']);
        // find all categories
        $categories = $categoryRepository->findBy([], ['id' => 'ASC']);

        return $this->render('category/list.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    #[Route('/{slug}', name: 'list')]
    public function list(Category $category, CategoryRepository $categoryRepository, $slug): Response
    {
        // find products of the category
        $products = $category->getProducts();
        // find all categories
        $categories = $categoryRepository->findBy([], ['id' => 'ASC']);

        return $this->render('category/list.html.twig', [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
            'slug' => $slug,
        ]);
    }
}
