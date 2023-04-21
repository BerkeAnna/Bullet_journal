<?php

namespace App\Repository;

use App\Entity\HabitTracker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HabitTracker>
 *
 * @method HabitTracker|null find($id, $lockMode = null, $lockVersion = null)
 * @method HabitTracker|null findOneBy(array $criteria, array $orderBy = null)
 * @method HabitTracker[]    findAll()
 * @method HabitTracker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HabitTrackerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HabitTracker::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(HabitTracker $entity, bool $flush = true): void
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
    public function remove(HabitTracker $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return HabitTracker[] Returns an array of HabitTracker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HabitTracker
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
