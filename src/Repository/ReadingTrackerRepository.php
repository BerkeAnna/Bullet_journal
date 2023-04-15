<?php

namespace App\Repository;

use App\Entity\ReadingTracker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReadingTracker>
 *
 * @method ReadingTracker|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReadingTracker|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReadingTracker[]    findAll()
 * @method ReadingTracker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReadingTrackerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReadingTracker::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ReadingTracker $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ReadingTracker $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ReadingTracker[] Returns an array of ReadingTracker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReadingTracker
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
