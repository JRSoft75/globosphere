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
//            $fieldQuery = new \Elastica\Query\MatchQuery();
            $fieldQuery = new \Elastica\Query\QueryString();
            $fieldQuery->setDefaultField('username');
            $fieldQuery->setQuery( '*'.$search->getUsername().'*');
            $query->addMust($fieldQuery);
//            $query->addMust(new Terms('username', [$search->getUsername()]));
        }
        if ($search->getFirstname() != null && $search->getFirstname() != '') {
//            $fieldQuery = new \Elastica\Query\SimpleQueryString('*'.$search->getFirstname().'*',['firstname']);
//            $fieldQuery->setFieldQuery('firstname', '*'.$search->getFirstname().'*');
            $fieldQuery = new \Elastica\Query\QueryString();
            $fieldQuery->setDefaultField('firstname');
            $fieldQuery->setQuery( '*'.$search->getFirstname().'*');
            $query->addMust($fieldQuery);
//            $query->addMust(new Terms('firstname', [$search->getFirstname()]));

        }
        if ($search->getLastname() != null && $search->getLastname() != '') {
//            $fieldQuery = new \Elastica\Query\MatchQuery();
//            $fieldQuery->setFieldQuery('lastname', $search->getLastname());
            $fieldQuery = new \Elastica\Query\QueryString();
            $fieldQuery->setDefaultField('lastname');
            $fieldQuery->setQuery( '*'.$search->getLastname().'*');
            $query->addMust($fieldQuery);
//            $query->addMust(new Terms('lastname', [$search->getLastname()]));
        }
        if ($search->getEmail() != null && $search->getEmail() != '') {
//            $fieldQuery = new \Elastica\Query\MatchQuery();
//            $fieldQuery->setFieldQuery('email', '*'.$search->getEmail().'*');
            $fieldQuery = new \Elastica\Query\QueryString();
            $fieldQuery->setDefaultField('email');
            $fieldQuery->setQuery( '*'.$search->getEmail().'*');
            $query->addMust($fieldQuery);
//            $query->addMust(new Terms('email', [$search->getEmail()]));
        }

        $query = Query::create($query);
        return $this->find($query,100);
    }

}
