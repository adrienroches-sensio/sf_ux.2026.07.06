<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Conference;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class ConferenceController extends AbstractController
{
    #[Route('/conference/new', name: 'app_conference_new', methods: ['GET'])]
    public function newConference(): Response
    {
        return $this->render('conference/new.html.twig');
    }

    #[Route('/conference', name: 'app_conference_list', methods: ['GET'])]
    public function list(
        #[MapQueryParameter('fromDate')]
        string $fromDateString = '',

        #[MapQueryParameter('toDate')]
        string $toDateString = '',
    ): Response {
        $fromDate = '' !== $fromDateString ? DateTimeImmutable::createFromFormat('Y-m-d', $fromDateString) : null;
        $toDate = '' !== $toDateString ? DateTimeImmutable::createFromFormat('Y-m-d', $toDateString) : null;

        return $this->render('conference/list.html.twig', [
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ]);
    }

    #[Route('/conference/{id}', name: 'app_conference_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Conference $conference): Response
    {
        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }
}
