<?php
namespace PinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="PinBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    const TYPE_REGULAR = 1;
    const TYPE_PARTTIME = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="type", type="integer")
     */
    protected $type = self::TYPE_REGULAR;

    /**
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="user")
     */
    protected $entries;


    public function __construct()
    {
        parent::__construct();
        $this->roles = ['ROLE_USER', 'ROLE_STUDENT'];
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function isRegular() {
        return $this->type === self::TYPE_REGULAR;
    }
}
