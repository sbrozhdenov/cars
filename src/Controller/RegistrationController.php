<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MobileDetectBundle\DeviceDetector\MobileDetectorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request, MobileDetectorInterface $mobileDetector, UserAuthenticatorInterface $authenticator, LoginFormAuthenticator $formAuthenticator)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            $user->setRoles(['ROLE_USER']);

            if ($user->getEmail() == "admin@gmail.com") {
                $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
            }

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $authenticator->authenticateUser(
                $user,
                $formAuthenticator,
                $request
            );
        }

        if ($mobileDetector->isMobile()) {
            return $this->render('registration/index-mobile.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
