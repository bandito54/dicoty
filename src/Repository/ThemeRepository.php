<?php

namespace App\Repository;

use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Theme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Theme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Theme[]    findAll()
 * @method Theme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Theme::class);
    }


     /**
     * @return ThemeByUser[]
     */
    public function findThemeOfUser($userid)
    {

        $qb = $this->createQueryBuilder('y');
        dump( $qb
             ->select('y.Description')
           
            ->orderBy('y.Description', 'ASC')
             ->getQuery()
             ->execute()

    );

    return( $qb
             ->select('y.Description')
            // ->from(Theme::class,'y')
            ->where('y.UserId = :uid')
            ->setParameter('uid', $userid)
            //  ->getQuery()
            //  ->execute()

    );

    // return $this->createQueryBuilder('u')
    //             ->groupBy('u.Description')
    //             ->orderBy('u.Description', 'ASC');
    }

    // /**
    //  * @return Theme[] Returns an array of Theme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Theme
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
