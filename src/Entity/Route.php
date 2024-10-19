<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $direction = null;

    /**
     * @var Collection<int, Stop>
     */
    #[ORM\ManyToMany(targetEntity: Stop::class, inversedBy: 'routes')]
    private Collection $stops;

    /**
     * @var Collection<int, Bus>
     */
    #[ORM\OneToMany(targetEntity: Bus::class, mappedBy: 'route')]
    private Collection $buses;

    public function __construct()
    {
        $this->stops = new ArrayCollection();
        $this->buses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Collection<int, Stop>
     */
    public function getStops(): Collection
    {
        return $this->stops;
    }

    public function addStop(Stop $stop): static
    {
        if (!$this->stops->contains($stop)) {
            $this->stops->add($stop);
        }

        return $this;
    }

    public function removeStop(Stop $stop): static
    {
        $this->stops->removeElement($stop);

        return $this;
    }

    /**
     * @return Collection<int, Bus>
     */
    public function getBuses(): Collection
    {
        return $this->buses;
    }

    public function addBus(Bus $bus): static
    {
        if (!$this->buses->contains($bus)) {
            $this->buses->add($bus);
            $bus->setRoute($this);
        }

        return $this;
    }

    public function removeBus(Bus $bus): static
    {
        if ($this->buses->removeElement($bus)) {
            // set the owning side to null (unless already changed)
            if ($bus->getRoute() === $this) {
                $bus->setRoute(null);
            }
        }

        return $this;
    }
}
