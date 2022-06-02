<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Listing;
use App\Form\ListingType;
use App\Repository\ListingRepository;
use Gedmo\Sluggable\Util\Urlizer;
use MobileDetectBundle\DeviceDetector\MobileDetectorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    /**
     * @Route("/listing", name="listing")
     */
    public function index(Request $request, ListingRepository $listingRepository)
    {
        $listing = $listingRepository->findBy(
            []
        );
        //dd($listing);
        return $this->render('listing/index.html.twig', [
            'listing' => $listing,
        ]);
    }


    /**
     * Creates a new Listing entity.
     *
     * @Route("listing/create", name="listing_create", methods={"GET","HEAD", "POST"})
     */
    public function createAction(Request $request, MobileDetectorInterface $mobileDetector)
    {
        $listing = new Listing();
        $form = $this->createForm(ListingType::class, $listing);

        $form->handleRequest($request);
       

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
