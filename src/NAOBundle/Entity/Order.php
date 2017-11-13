<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 10/11/2017
 * Time: 16:09
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package NAOBundle\Entity
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\OrderRepository")
 */
class Order
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
     * @ORM\Column(type="string", length=20)
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