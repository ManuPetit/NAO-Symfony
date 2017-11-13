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
 * Class Bird
 * @package NAOBundle\Entity
 * @ORM\Table(name="birds")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\BirdRepository")
 */
class Bird
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $cdNom;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $latinName;

    /**
     * @var string
     * @ORM\Column(type="string", length=110, nullable=true)
     */
    private $frenchName;

    /**
     * @var string
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Family
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Family", inversedBy="birds", cascade={"persist"})
     * @ORM\JoinColumn(name="family_id",referencedColumnName="id")
     */
    private $family;

    /**
     * @var Habitat
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Habitat")
     * @ORM\JoinColumn(name="habitat_id",referencedColumnName="id")
     */
    private $habitat;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="NAOBundle\Entity\Picture", mappedBy="bird")
     */
    private $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCdNom()
    {
        return $this->cdNom;
    }

    /**
     * @param int $cdNom
     */
    public function setCdNom($cdNom)
    {
        $this->cdNom = $cdNom;
    }

    /**
     * @return string
     */
    public function getLatinName()
    {
        return $this->latinName;
    }

    /**
     * @param string $latinName
     */
    public function setLatinName($latinName)
    {
        $this->latinName = $latinName;
    }

    /**
     * @return string
     */
    public function getFrenchName()
    {
        return $this->frenchName;
    }

    /**
     * @param string $frenchName
     */
    public function setFrenchName($frenchName)
    {
        $this->frenchName = $frenchName;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param Family $family
     */
    public function setFamily(Family $family)
    {
        $this->family = $family;
    }

    /**
     * @return Habitat
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * @param Habitat $habitat
     */
    public function setHabitat(Habitat $habitat)
    {
        $this->habitat = $habitat;
    }

    /**
     * @return ArrayCollection|Picture[]
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @param Picture $picture
     */
    public function addPicture(Picture $picture){
        $this->pictures[] = $picture;
        $picture->setBird($this);
    }

    /**
     * @param Picture $picture
     */
    public function removePicture(Picture $picture)
    {
        $this->pictures->removeElement($picture);
        $picture->setBird(null);
    }

}