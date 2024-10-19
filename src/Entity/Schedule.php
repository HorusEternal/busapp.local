<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $arrival_times = [];

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    private ?Bus $bus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivalTimes(): array
    {
        return $this->arrival_times;
    }

    public function setArrivalTimes(array $arrival_times): static
    {
        $this->arrival_times = $arrival_times;

        return $this;
    }

    public function getBus(): ?Bus
    {
        return $this->bus;
    }

    public function setBus(?Bus $bus): static
    {
        $this->bus = $bus;

        return $this;
    }
}
