<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:14
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * Class MainStatus
 * @package NAOBundle\Entity
 * @ORM\Table(name="main_statuses")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\MainStatusRepository")
 */
class MainStatus
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
     * @ORM\Column(type="string", length=25)
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