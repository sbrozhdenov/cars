<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("contact/create", name="contact_create", methods={"GET","HEAD", "POST"})
     */
    public function index(MailerInterface $mailer, Request $request): Response
    {
        $session = new Session();
 
        $email = (new Email())
            ->from($request->request->get('email', ''))
            ->to('stefan.brojdenov@gmail.com')
            ->subject($request->request->get('title', ''))
            ->text($request->request->get('question', ''));
           
        $mailer->send($email);

        $session->set('notice', 'Благодаря за запитването!');

        return $this->redirectToRoute('app_home');
    }
}
