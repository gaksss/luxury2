<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager, Request $request, FileUploader $fileUploader): Response
    {
        /** @var User */
        $user = $this->getUser();

        $candidate = $user->getCandidate();

        if (!$candidate) {
            $candidate = new Candidate();
            $candidate->setUser($user);
            $entityManager->persist($candidate);
            $entityManager->flush();
        }

        if (!$user->isVerified()) {
            return $this->render('errors/not-verified.html.twig', []);
        }

        $formCandidate = $this->createForm(CandidateType::class, $candidate);
        $formCandidate->handleRequest($request);

        if ($formCandidate->isSubmitted() && $formCandidate->isValid()) {
            // dd($candidate);
            $profilPictureFile = $formCandidate->get('profilePictureFile')->getData();
            $passportFile = $formCandidate->get('passportFile')->getData();
            $cvFile = $formCandidate->get('cvFile')->getData();
            // dd($profilPictureFile);


            if ($profilPictureFile) {
                $profilPictureName = $fileUploader->upload($profilPictureFile, $candidate, 'profilePicture', 'profile_pictures');
                $candidate->setProfilePicture($profilPictureName);
            }


            if ($passportFile) {
                $passportName = $fileUploader->upload($passportFile, $candidate, 'passport', 'passports');
                $candidate->setPassport($passportName);
            }

            if ($cvFile) {
                $cvName = $fileUploader->upload($cvFile, $candidate, 'cv', 'cvs');
                $candidate->setCv($cvName);
            }

            $entityManager->persist($candidate);
            $entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully');
        }




        return $this->render('profile/index.html.twig', [
            'form' => $formCandidate->createView(),
            'candidate' => $candidate,

        ]);
    }
}
