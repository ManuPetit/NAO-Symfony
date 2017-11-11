<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:14
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Photo
 * @package NAOBundle\Entity
 * @ORM\Table(name="photos")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(type="string", length=75)
     */
    private $file;

    /**
     * @var Observation
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Observation", inversedBy="photos")
     * @ORM\JoinColumn(name="observation_id", referencedColumnName="id")
     */
    private $observation;

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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return Observation
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param Observation $observation
     */
    public function setObservation(Observation $observation)
    {
        $this->observation = $observation;
    }


}