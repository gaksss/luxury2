<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private JobOfferRepository $jobOfferRepository
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $jobs = $this->jobOfferRepository->findAll();

        return $this->render('home/index.html.twig', [
            'jobs' => $jobs
        ]);
    }
}
