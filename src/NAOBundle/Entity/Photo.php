<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 11/11/2017
 * Time: 08:14
 */

namespace NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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

    public function getFile()
    {
        return $this->file;
    }

    function setFile(UploadedFile $file)
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

    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
            return;
        }

        // On récupère le nom original du fichier de l'internaute
        $name = $this->file->getClientOriginalName();

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadRootDir(), $name);

        // On sauvegarde le nom de fichier dans notre attribut $url
        $this->url = $name;

        // On crée également le futur attribut alt de notre balise <img>
        $this->alt = $name;
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return 'img/observations';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

}
