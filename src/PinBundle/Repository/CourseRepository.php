<?php
namespace PinBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CourseRepository extends EntityRepository
{
	public function getAllExcludingByIds($courseIds)
    {
        $dql = '
            SELECT course
            FROM PinBundle\Entity\Course course
        ';

        if (!empty($courseIds)) {
            $dql .= 'WHERE course.id NOT IN (:courseIds)';
        }

        $q = $this->getEntityManager()->createQuery($dql);

        if (!empty($courseIds)) {
            $q->setParameter('courseIds', $courseIds);
        }

        return $q->getResult();
    }
}
