<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Listing;
use App\Entity\User;
use App\Form\ListingType;
use App\Repository\ListingRepository;
use App\Repository\UserRepository;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\Session\Session;
use MobileDetectBundle\DeviceDetector\MobileDetectorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    /**
     * @Route("/listing", name="listing")
     */
    public function index(Request $request, ListingRepository $listingRepository, UserRepository $userRepository)
    {
        $user = $this->getUser();
        $session = new Session();
        $pathData = [];
        $user = $userRepository->find($user->getId());
        $listing = $user->getListings()->getValues();
 
        foreach ($listing as $data) {
            foreach ($data->getPath() as $path) {
                $pathData[] = ["path" => 'uploads/'.$path, "caption" => $data->getMark()];
            }
            $data->setPath($pathData);
        }
        
        return $this->render('listing/index.html.twig', [
            'listing' => $listing,
            "notice" => $session->get('notice', null)
        ]);
    }


    /**
     * Creates a new Listing entity.
     *
     * @Route("listing/create", name="listing_create", methods={"GET","HEAD", "POST"})
     */
    public function createAction(Request $request, MobileDetectorInterface $mobileDetector, EntityManagerInterface $entityManager)
    {
        $listing = new Listing();
        $form = $this->createForm(ListingType::class, $listing);
        $repository = $entityManager->getRepository(User::class);
        $user = $repository->findOneBy(['email' => $request->request->get('email')]);

        $form->handleRequest($request);

        $session = new Session();
        $session->remove('notice');
       

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $uploadedFile = $form['path']->getData();
            $destination = $this->getParameter('kernel.project_dir').'\public\uploads';
            $paths = [];
          
            foreach ($uploadedFile as $file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$file->guessExtension();
                $paths[] = $newFilename;
                $file->move(
                    $destination,
                    $newFilename
                );
            }
            $listing->setPath($paths);
            $listing->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($listing);
            $em->flush();

            return $this->redirectToRoute('listing');
        }

        return $this->render('listing/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
