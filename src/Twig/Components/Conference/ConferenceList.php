<?php

declare(strict_types=1);

namespace App\Twig\Components\Conference;

use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ConferenceList
{
    use DefaultActionTrait;

    #[LiveProp]
    public DateTimeInterface|null $fromDate = null;

    #[LiveProp]
    public DateTimeInterface|null $toDate = null;

    public function __construct(
        private ConferenceRepository $conferenceRepository,
    ) {
    }

    /**
     * @return list<Conference>
     */
    public function getConferences(): array
    {
        if ($this->fromDate instanceof  DateTimeImmutable || $this->toDate instanceof DateTimeImmutable) {
            $conferences = $this->conferenceRepository->findConferencesBetweenDates($this->fromDate, $this->toDate);
        } else {
            $conferences = $this->conferenceRepository->findAll();
        }

        return $conferences;
    }
}
