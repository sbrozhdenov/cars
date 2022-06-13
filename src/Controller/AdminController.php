<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="app_admin_show")
     */
    public function show(UserRepository $userRepository, Request $request): Response
    {
        return $this->render('admin/show.html.twig', [
            'user' => $userRepository->findOneBy(['id' => $request->attributes->get('id')])
        ]);
    }
}
