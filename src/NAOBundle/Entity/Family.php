<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 10/11/2017
 * Time: 16:09
 */

namespace NAOBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Family
 * @package NAOBundle\Entity
 * @ORM\Table(name="families")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\FamilyRepository")
 */
class Family
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
     * @var Order
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Order")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="NAOBundle\Entity\Bird", mappedBy="family")
     */
    private $birds;

    public function __construct()
    {
        $this->birds = new ArrayCollection();
    }

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
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return ArrayCollection|Bird[]
     */
    public function getBirds()
    {
        return $this->birds;
    }

    /**
     * @param Bird $bird
     */
    public function addBird(Bird $bird)
    {
        $this->birds[] = $bird;
        $bird->setFamily($this);
    }

    /**
     * @param Bird $bird
     */
    public function removeBird(Bird $bird)
    {
        $this->birds->removeElement($bird);
        $bird->setFamily(null);
    }
}