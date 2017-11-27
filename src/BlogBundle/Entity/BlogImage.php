<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:07
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eventviva\ImageResize;
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
        $ext = $this->upFile->guessExtension();
        //we resize the file to be 1000 * 750
        $image = new ImageResize($this->upFile);
        $image->crop(1000,750, ImageResize::CROPCENTER);
        // change the name of file
        $fileName = $this->generateFileName() . '.' . $ext;
        if ($ext ='png') {
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_PNG, 2);
        } elseif ($ext = 'jpg' || $ext = 'jpeg'){
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_JPEG, 75);
        } elseif ($ext = 'gif'){
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_GIF, 50);
        }
        //$image->move($this->getUploadRootDir(), $fileName);
        $this->file = $fileName;
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

    private function generateFileName(){
        //generate random 8 letters word
        $letter = array_merge(range('a', 'z'), range('A', 'Z'), range(0,9));
        shuffle($letter);
        $word = substr(implode($letter), 0, 15);
        return date('Ymd_His') . $word;
    }

}