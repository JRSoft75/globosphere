<?php

namespace App\Repository;

use App\Entity\User;
//use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
//use FOS\ElasticaBundle\Repository;
//use Elastica\Query\BoolQuery;
//use Elastica\Query\Terms;
//use Elastica\Query;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
//    // This searchUser function will build the elasticsearch query to get a list of users that match our criterias
//    public function searchUser(User $search)
//    {
//        $query = new BoolQuery();
//        if ($search->getUsername() != null && $search->getUsername() != '') {
//            $query->addMust(new Terms('username', [$search->getUsername()]));
//        }
//        if ($search->getFirstname() != null && $search->getFirstname() != '') {
//            $query->addMust(new Terms('firstname', [$search->getFirstname()]));
//        }
//        if ($search->getLastname() != null && $search->getLastname() != '') {
//            $query->addMust(new Terms('lastname', [$search->getLastname()]));
//        }
//        if ($search->getEmail() != null && $search->getEmail() != '') {
//            $query->addMust(new Terms('email', [$search->getEmail()]));
//        }
//
//        $query = Query::create($query);
//
//        return $this->find($query);
//    }

}
