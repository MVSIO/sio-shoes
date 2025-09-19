<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Category;
use App\Form\CategoryTypeform;
use Symfony\Component\HttpFoundation\Request;


final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    #[Route('/category/new', name: 'app_category_new')]
    public function addCategory(EntityManagerInterface $entityManager, Request $request): Response
    {
        $category= new Category();
        $form = $this->createForm (CategoryTypeForn::class, $category); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category); 
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
    }
    return $this->render('category/new.html.twig', ['categoryForm'=>
    $form->createView()]);
        }
    }
}