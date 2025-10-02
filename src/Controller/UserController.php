<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'app_user')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }
    #[Route('/admin/user/{id}/add/editor', name: 'app_user_add_editor_role')]
    public function editorRoleAdd(User $user, EntityManagerInterface $entityManager):Response
    {
        $user->setRoles(["ROLE_EDITOR","ROLE_USER"]);
        $entityManager->flush();

        $this-> addFlash('success','Le rôle éditeur a été ajouteé à l\'utilisateur');
        return $this->redirectToRoute('app_user');
    }
    #[Route('/admin/user/{id}/remove/editor',name:'app_user_remove_editor_role')]
}