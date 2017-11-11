<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 10/11/2017
 * Time: 16:08
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Habitat
 * @package NAOBundle\Entity
 * @ORM\Table(name="habitats")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\HabitatRepository")
 */
class Habitat
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
     * @ORM\Column(type="string", length=40)
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