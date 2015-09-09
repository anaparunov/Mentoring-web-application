<?php
namespace PinBundle\Repository;

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository
{
    public function getStudents()
    {
        $dql = '
            SELECT user
            FROM PinBundle\Entity\User user
            WHERE user.roles NOT LIKE :role
        ';

        $q = $this->getEntityManager()
            ->createQuery($dql)->setParameter('role', '%ROLE_ADMIN%');

        return $q->getResult();
    }
}
