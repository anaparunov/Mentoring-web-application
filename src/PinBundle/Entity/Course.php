<?php
namespace PinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="PinBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="course")
     */
    protected $entries;

    /**
     * @ORM\Column(name="name", type="text")
     */
    protected $name;

    /**
     * @ORM\Column(name="code", type="text", length=16)
     */
    protected $code;

    /**
     * @ORM\Column(name="semester_regular", type="integer")
     */
    protected $semesterRegular;

    /**
     * @ORM\Column(name="semestar_parttime", type="integer")
     */
    protected $semesterPartTime;

    /**
     * @ORM\Column(name="score", type="integer")
     */
    protected $score;

    /**
     * @ORM\Column(name="optional", type="boolean")
     */
    protected $optional = false;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getSemesterRegular()
    {
        return $this->semesterRegular;
    }
    public function setSemesterRegular($semesterRegular)
    {
        $this->semesterRegular = $semesterRegular;
        return $this;
    }

    public function getSemesterPartTime()
    {
        return $this->semesterPartTime;
    }
    public function setSemesterPartTime($semesterPartTime)
    {
        $this->semesterPartTime = $semesterPartTime;
        return $this;
    }

    public function getScore()
    {
        return $this->score;
    }
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    public function getOptional()
    {
        return $this->optional;
    }
    public function setOptional($optional)
    {
        $this->optional = $optional;
        return $this;
    }
}
