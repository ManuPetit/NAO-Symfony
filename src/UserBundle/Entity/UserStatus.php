<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:35
 */

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserStatus
 * @package UserBundle\Entity
 * @ORM\Table(name="user_statuses")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserStatusRepository")
 */
class UserStatus
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}