<?php
namespace PinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use PinBundle\Entity\Course;
use PinBundle\Entity\User;


/**
 * @ORM\Entity
 * @ORM\Table(name="entry")
 * @ORM\Entity(repositoryClass="PinBundle\Repository\EntryRepository")
 */
class Entry
{
    const STATUS_CANCELLED = 0;
    const STATUS_REQUESTED = 1;
    const STATUS_APPROVED = 2;
    const STATUS_PASSED = 3;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="entries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="cascade")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="entries")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="cascade")
     */
    protected $course;

    /**
     * @ORM\Column(name="status", type="text", length=64)
     */
    protected $status = self::STATUS_CANCELLED;


    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getCourse()
    {
        return $this->course;
    }
    public function setCourse(Course $course)
    {
        $this->course = $course;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function isRequested()
    {
        return $this->status === self::STATUS_REQUESTED;
    }
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }
    public function isPassed()
    {
        return $this->status === self::STATUS_PASSED;
    }
}
