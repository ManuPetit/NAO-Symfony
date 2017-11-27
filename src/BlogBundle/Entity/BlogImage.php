<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:07
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BlogImage
 * @package BlogBundle\Entity
 * @ORM\Table(name="blog_image")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\BlogImageRepository")
 */
class BlogImage
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
    private $file;

    /**
     * @var \BlogBundle\Entity\Post
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Post", inversedBy="blogImages")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * Image file to uploaded
     * @var string
     */
    private $upFile;

    /**
     * @return mixed
     */
    public function getUpFile()
    {
        return $this->upFile;
    }

    /**
     * @param mixed $upFile
     */
    public function setUpFile(UploadedFile $upFile = null)
    {
        $this->upFile = $upFile;
    }

    public function upload()
    {
        if (null === $this->upFile)
        {
            return;
        }
        $file = $this->upFile->getClientOriginalName();
        $this->upFile->move($this->getUploadRootDir(), $file);
        $this->file = $file;
    }

    public function getUploadDir()
    {
        return 'img/posts';
    }
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
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
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }



}