<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/products', name: 'admin_products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProductRepository $productRepository,): Response
    {
        // find all products
        $products = $productRepository->findBy([], ['updated_at' => 'DESC']);

        return $this->render('admin/products/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response
    {
        //create new product
        $product = new Product();

        //create form
        $productForm = $this->createForm(ProductFormType::class, $product);

        //process the form request
        $productForm->handleRequest($request);

        //check if form is submitted and valid
        if($productForm->isSubmitted() && $productForm->isValid()) {
            //generate slug with the product name
            $slug = $slugger->slug($product->getName())->lower();
            $product->setSlug($slug);

            //image file
            /** @var UploadedFile $imageFile */
            $imageFile = $productForm->get('image')->getData();

            // this condition is needed because the 'image' field is not required
            // so the Image file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // move the file to the directory where images are stored
                try {
                    $imageFile->move(
                        $this->getParameter('products_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'image' property to store the Image file name
                // instead of its contents
                $product->setImage($newFilename);
            }

            // persist the $product variable or any other work
            $entityManager->persist($product);
            $entityManager->flush();
            
            //display success message
            $this->addFlash('success', 'Produit ajouté avec succès');

            //redirect to products list
            return $this->redirectToRoute('admin_products_index');

        }

        return $this->render('admin/products/add.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(
        Product $product,
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response
    {
        //create form
        $productForm = $this->createForm(ProductFormType::class, $product);

        //process the form request
        $productForm->handleRequest($request);

        //check if form is submitted and valid
        if($productForm->isSubmitted() && $productForm->isValid()) {
            //generate slug with the product name
            $slug = $slugger->slug($product->getName())->lower();
            $product->setSlug($slug);

            /** @var UploadedFile $imageFile */
            $imageFile = $productForm->get('image')->getData();

            // this condition is needed because the 'image' field is not required
            // so the Image file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // move the file to the directory where images are stored
                try {
                    $imageFile->move(
                        $this->getParameter('products_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'image' property to store the Image file name
                // instead of its contents
                $product->setImage($newFilename);
            }

            // persist the $product variable or any other work
            $entityManager->persist($product);
            $entityManager->flush();
            
            //display success message
            $this->addFlash('success', 'Produit modifié avec succès');

            //redirect to products list
            return $this->redirectToRoute('admin_products_index');

        }

        return $this->render('admin/products/edit.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Product $product): Response
    {
        return $this->render('admin/products/index.html.twig', [
            
        ]);
    }
}
