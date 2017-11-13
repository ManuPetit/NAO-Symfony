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
 * Class Picture
 * @package NAOBundle\Entity
 * @ORM\Table(name="pictures")
 * @ORM\Entity(repositoryClass="NAOBundle\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\Column(type="string", length=100)
     */
    private $link;

    /**
     * @var string
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $author;

    /**
     * @var Bird
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\Bird", inversedBy="pictures", cascade={"persist"})
     * @ORM\JoinColumn(name="bird_id", referencedColumnName="id")
     */
    private $bird;

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
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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


}