<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/categories', name: 'admin_categories_')]
class AdminCategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository,): Response
    {
        // find all categories
        $categories = $categoryRepository->findBy([], ['name' => 'ASC']);

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response
    {
        //create new category
        $category = new Category();

        //create form
        $categoryForm = $this->createForm(CategoryFormType::class, $category);

        //process the form request
        $categoryForm->handleRequest($request);

        //check if form is submitted and valid
        if($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            
            //generate slug with the category name
            $slug = $slugger->slug($category->getName())->lower();
            $category->setSlug($slug);

            // persist the $category variable or any other work
            $entityManager->persist($category);
            $entityManager->flush();
            
            //display success message
            $this->addFlash('success', 'Catégorie ajoutée avec succès');

            //redirect to categories list
            return $this->redirectToRoute('admin_categories_index');

        }

        return $this->render('admin/category/add.html.twig', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(
        category $category,
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response
    {
        //create form
        $categoryForm = $this->createForm(CategoryFormType::class, $category);

        //process the form request
        $categoryForm->handleRequest($request);

        //check if form is submitted and valid
        if($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            
            //generate slug with the category name
            $slug = $slugger->slug($category->getName())->lower();
            $category->setSlug($slug);

            // persist the $category variable or any other work
            $entityManager->persist($category);
            $entityManager->flush();
            
            //display success message
            $this->addFlash('success', 'Catégorie modifiée avec succès');

            //redirect to categories list
            return $this->redirectToRoute('admin_categories_index');

        }

        return $this->render('admin/category/edit.html.twig', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(
        Category $category,
        EntityManagerInterface $entityManager
    ): Response
    {
        // if category exists
        if($category){

            // delete category from database
            $entityManager->remove($category);
            // execute transaction
            $entityManager->flush();
            // and display success message
            $this->addFlash('success', 'Catégorie supprimé avec succès');
        } 
        // if there isn't a category with this id
        else {
            // display error message
            $this->addFlash('danger', 'La catégorie n\'existe pas.');
        }
        //redirect to categorys list
        return $this->redirectToRoute('admin_categories_index');

        return $this->render('admin/category/index.html.twig', [
            
        ]);
    }
}