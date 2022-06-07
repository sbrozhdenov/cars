<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MobileDetectBundle\DeviceDetector\MobileDetectorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, MobileDetectorInterface $mobileDetector): Response
    {
        $user = new User();
        $error = $authenticationUtils->getLastAuthenticationError();
        
        if ($mobileDetector->isMobile()) {
            return $this->render('security/login-mobile.html.twig', [ 'error' => $error]);
        }
        return $this->render('security/login.html.twig', [ 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
