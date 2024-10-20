<?php

namespace App\Repository;

use App\Entity\Bus;
use App\Entity\Schedule;
use App\Entity\Stop;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bus>
 */
class BusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bus::class);
    }

}
