<?php

namespace App\Repository;

use App\Entity\User;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use FOS\ElasticaBundle\Repository;
use Elastica\Query\BoolQuery;
use Elastica\Query\Terms;
use Elastica\Query;


class SearchRepository extends Repository
{

    // This searchUser function will build the elasticsearch query to get a list of users that match our criterias
    public function searchUser(User $search)
    {
        $query = new BoolQuery();

        if ($search->getUsername() != null && $search->getUsername() != '') {
            $fieldQuery = new \Elastica\Query\MatchQuery();
//            $fieldQuery->setFieldQuery('username', '*'.$search->getUsername().'*');
            $fieldQuery->setFieldParam('username', 'analyzer', 'my_analyzer');
            $query->addShould($fieldQuery);
//            $query->addMust(new Terms('username', [$search->getUsername()]));
        }
        if ($search->getFirstname() != null && $search->getFirstname() != '') {
            $fieldQuery = new \Elastica\Query\MatchQuery();
            $fieldQuery->setFieldQuery('firstname', '*'.$search->getFirstname().'*');
            $query->addShould($fieldQuery);
//            $query->addMust(new Terms('firstname', [$search->getFirstname()]));
        }
        if ($search->getLastname() != null && $search->getLastname() != '') {
            $fieldQuery = new \Elastica\Query\MatchQuery();
            $fieldQuery->setFieldQuery('lastname', $search->getLastname());
            $query->addShould($fieldQuery);
//            $query->addMust(new Terms('lastname', [$search->getLastname()]));
        }
        if ($search->getEmail() != null && $search->getEmail() != '') {
            $fieldQuery = new \Elastica\Query\MatchQuery();
            $fieldQuery->setFieldQuery('email', '*'.$search->getEmail().'*');
            $query->addShould($fieldQuery);
//            $query->addMust(new Terms('email', [$search->getEmail()]));
        }

        $query = Query::create($query);
dump('$query');
dump($query);
        return $this->find($query,20);
    }

}
