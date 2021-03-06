<?php
/**
 * Location Repository
 */
namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class LocationRepository
 * @package App\Repository
 */
class LocationRepository extends ServiceEntityRepository
{
    /**
     * LocationRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Location::class);
    }
}
