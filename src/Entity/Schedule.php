<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Bus::class)]
    private Bus $bus;

    #[ORM\ManyToOne(targetEntity: Stop::class)]
    private Stop $from;

    #[ORM\ManyToOne(targetEntity: Stop::class)]
    private Stop $to;

    #[ORM\Column(type: 'json')]
    private array $arrivalTimes = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Bus
     */
    public function getBus(): Bus
    {
        return $this->bus;
    }

    /**
     * @param Bus $bus
     * @return Schedule
     */
    public function setBus(Bus $bus): Schedule
    {
        $this->bus = $bus;
        return $this;
    }

    /**
     * @return Stop
     */
    public function getFrom(): Stop
    {
        return $this->from;
    }

    /**
     * @param Stop $from
     * @return Schedule
     */
    public function setFrom(Stop $from): Schedule
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Stop
     */
    public function getTo(): Stop
    {
        return $this->to;
    }

    /**
     * @param Stop $to
     * @return Schedule
     */
    public function setTo(Stop $to): Schedule
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return array
     */
    public function getArrivalTimes(): array
    {
        return $this->arrivalTimes;
    }

    /**
     * @param array $arrivalTimes
     * @return Schedule
     */
    public function setArrivalTimes(array $arrivalTimes): Schedule
    {
        $this->arrivalTimes = $arrivalTimes;
        return $this;
    }
}
