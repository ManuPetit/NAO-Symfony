<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:34
 */

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Role
 * @package UserBundle\Entity
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\RoleRepository")
 */
class Role
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
     * @var string
     * @ORM\Column(type="string", length=45)
     */
    private $currentName;

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

    /**
     * @return string
     */
    public function getCurrentName()
    {
        return $this->currentName;
    }

    /**
     * @param string $currentName
     */
    public function setCurrentName($currentName)
    {
        $this->currentName = $currentName;
    }

}