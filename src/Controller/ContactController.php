<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Crypto\SMimeSigner;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("contact/create", name="contact_create", methods={"GET","HEAD", "POST"})
     */
    public function index(MailerInterface $mailer, Request $request): Response
    {
        $session = new Session();
        $signer = new SMimeSigner(
            $this->getParameter('kernel.project_dir'). DIRECTORY_SEPARATOR . 'certificate.crt',
            $this->getParameter('kernel.project_dir'). DIRECTORY_SEPARATOR . 'privatekey.key'
        );

        $email = (new Email())
            ->from('sbcarsst@sbcars.store')
            ->to('stefan.brojdenov@gmail.com')
            ->subject($request->request->get('title', '') . $request->request->get('email', ''))
            ->text($request->request->get('question', '') . $request->request->get('name', '') . $request->request->get('phone', ''));

        $signedEmail = $signer->sign($email);

           
        $mailer->send($signedEmail);

        $session->set('notice', 'Благодаря за запитването!');

        return $this->redirectToRoute('app_home');
    }
}
