<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:14
 */

namespace NAOBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Class Observation
 * @package NAOBundle\Entity
 * @ORM\Table(name="observations")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=9, scale=6)
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=9, scale=6)
     */
    private $longitude;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="observations", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Bird
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Bird")
     * @ORM\JoinColumn(name="bird_id",referencedColumnName="id")
     */
    private $bird;

    /**
     * @var MainStatus
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\MainStatus")
     * @ORM\JoinColumn(name="main_status_id", referencedColumnName="id")
     */
    private $mainStatus;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="NAOBundle\Entity\Photo", mappedBy="observation")
     */
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Bird
     */
    public function getBird()
    {
        return $this->bird;
    }

    /**
     * @param Bird $bird
     */
    public function setBird(Bird $bird)
    {
        $this->bird = $bird;
    }

    /**
     * @return MainStatus
     */
    public function getMainStatus()
    {
        return $this->mainStatus;
    }

    /**
     * @param MainStatus $mainStatus
     */
    public function setMainStatus(MainStatus $mainStatus)
    {
        $this->mainStatus = $mainStatus;
    }

    /**
     * @return ArrayCollection|Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param Photo $photo
     */
    public function addPhoto(Photo $photo)
    {
        $this->photos[] = $photo;
        $photo->setObservation($this);
    }

    /**
     * @param Photo $photo
     */
    public function removePhoto(Photo $photo)
    {
        $this->photos->removeElement($photo);
        $photo->setObservation(null);
    }

}