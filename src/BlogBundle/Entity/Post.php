<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:03
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use UserBundle\Entity\User;
use NAOBundle\Entity\MainStatus;

/**
 * Class Post
 * @package BlogBundle\Entity
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\PostRepository")
 */
class Post
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrer un titre.")
     * @Assert\Length(min=3, max=255,
     *     minMessage="Le titre choisi est trop court.",
     *     maxMessage="Le titre choisi est trop long.")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez entrer du contenu.")
     */
    private $content;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\BlogImage", mappedBy="post")
     */
    private $blogImages;

    /**
     * @var MainStatus
     * @ORM\ManyToOne(targetEntity="NAOBundle\Entity\MainStatus")
     * @ORM\JoinColumn(name="main_status_id", referencedColumnName="id")
     */
    private $mainStatus;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct()
    {
        $this->blogImages = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getBlogImages()
    {
        return $this->blogImages;
    }

    /**
     * @param BlogImage $blogImage
     */
    public function addBlogImage(BlogImage $blogImage){
        $this->blogImages[] = $blogImage;
        $blogImage->setPost($this);
    }

    /**
     * @param BlogImage $blogImage
     */
    public function removeBlogImage(BlogImage $blogImage){
        $this->blogImages->removeElement($blogImage);
        $blogImage->setPost(null);
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

}