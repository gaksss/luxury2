<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    public function __construct(
        private JobOfferRepository $jobOfferRepository
    ) {}

    #[Route('/job', name: 'app_job')]
    public function index(): Response
    {
        $jobs = $this->jobOfferRepository->findAll();

        return $this->render('job/index.html.twig', [
            'jobs' => $jobs
        ]);
    }

    #[Route('/job/{id}', name: 'app_job_show')]
    public function show(int $id): Response
    {

        $job = $this->jobOfferRepository->find($id);

        return $this->render('job/show.html.twig', [
            'job' => $job
        ]);
    }
}
