<?php

declare(strict_types=1);

namespace App\Twig\Components\Conference;

use App\Form\ConferenceFilterType;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListFilterForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(writable: true, url: true)]
    public DateTimeImmutable|null $fromDate = null;

    #[LiveProp(writable: true, url: true)]
    public DateTimeImmutable|null $toDate = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ConferenceFilterType::class, [
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);
    }

    #[LiveAction]
    public function filter(): Response
    {
        $this->submitForm();

//        [
//            'fromDate' => $fromDate,
//            'toDate' => $toDate,
//        ] = $this->getForm()->getData();
// is equivalent to (see destructuring)

        $formData = $this->getForm()->getData();
        /** @var DateTimeImmutable $fromDate */
        $this->fromDate = $formData['fromDate'];
        /** @var DateTimeImmutable $toDate */
        $this->toDate = $formData['toDate'];

        return $this->redirectToRoute('app_conference_list', [
            'fromDate' => $this->fromDate?->format(DateTimeInterface::ATOM),
            'toDate' => $this->toDate?->format(DateTimeInterface::ATOM),
        ]);
    }
}
