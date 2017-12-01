<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:14
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eventviva\ImageResize;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    private $fileAdd;
    public function getFileAdd()
    {
        return $this->fileAdd;
    }
    public function setFileAdd(UploadedFile $fileAdd = null)
    {
        $this->fileAdd = $fileAdd;
    }
    public function upload()
    {
        if (null === $this->fileAdd)
        {
            return;
        }
        $ext = $this->fileAdd->guessExtension();
        //we resize the file to be 1000 x 600
        $image = new ImageResize($this->fileAdd);
        $image->crop(1000,600, ImageResize::CROPCENTER);
        //change the name of file
        $fileName = $this->generateFileName() . '.' . $ext;
        if ($ext ='png') {
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_PNG, 2);
        } elseif ($ext = 'jpg' || $ext = 'jpeg'){
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_JPEG, 75);
        } elseif ($ext = 'gif'){
            $image->save($this->getUploadRootDir() . '/' . $fileName, IMAGETYPE_GIF, 50);
        }
        $this->file = $fileName;
        /*$file = $this->fileAdd->getClientOriginalName();
        $this->fileAdd->move($this->getUploadRootDir(), $file);
        $this->file = $file;*/
    }

    public function getUploadDir()
    {
        return 'img/observations';
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

    private function generateFileName(){
        //generate random 8 letters word
        $letter = array_merge(range('a', 'z'), range('A', 'Z'), range(0,9));
        shuffle($letter);
        $word = substr(implode($letter), 0, 15);
        return date('Ymd_His') . $word;
    }
}
