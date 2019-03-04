<?php

namespace App\Repository;

use App\Entity\Abonnes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Abonnes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abonnes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abonnes[]    findAll()
 * @method Abonnes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonnesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Abonnes::class);
    }

    /**
     * @param $value
     * @return Abonnes[] Returns an array of Abonnes objects
     */

    public function findByNineaField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.ninea = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param $value
     * @return Abonnes|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneBySomeField($value): ?Abonnes
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
