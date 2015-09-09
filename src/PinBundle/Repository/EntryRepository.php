<?php
namespace PinBundle\Repository;

use Doctrine\ORM\EntityRepository;

use PinBundle\Entity\Entry;
use PinBundle\Entity\User;


class EntryRepository extends EntityRepository
{
    public function getEntriesByStudent(User $user)
    {
        $dql = '
            SELECT entry
            FROM PinBundle\Entity\Entry entry
            LEFT JOIN entry.course course
            WHERE entry.user = :user
            AND entry.status != :status
        ';

        $q = $this->getEntityManager()->createQuery($dql)
            ->setParameter('user', $user)
            ->setParameter('status', Entry::STATUS_CANCELLED)
        ;

        return $q->getResult();
    }
}
