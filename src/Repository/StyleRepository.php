<?php
/**
 * Style Repository
 */
namespace App\Repository;

use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class StyleRepository
 * @package App\Repository
 *
 * @method Style|null find($id, $lockMode = null, $lockVersion = null)
 * @method Style|null findOneBy(array $criteria, array $orderBy = null)
 * @method Style[]    findAll()
 * @method Style[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StyleRepository extends ServiceEntityRepository
{
    /**
     * StyleRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Style::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
