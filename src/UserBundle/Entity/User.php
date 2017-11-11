<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 09/11/2017
 * Time: 16:34
 */

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use NAOBundle\Entity\Observation;

/**
 * Class User
 * @package UserBundle\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Veuillez entrer votre email.")
     * @Assert\Email(message="Veuillez vérifier le format de votre email.")
     * @Assert\Length(max=100, maxMessage="Votre email est trop long.")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=45, unique=true)
     * @Assert\NotBlank(message="Veuillez enter un nom de connexion.")
     * @Assert\Length(min=4, max=45,
     *     minMessage="Votre nom de connexion est trop court.",
     *     maxMessage="Votre nom de de connexion est trop long")
     */
    private $login;

    /**
     * @var string
     * @ORM\Column(type="string", length=80)
     */
    private $mdp;

    /**
     * @var string
     * @ORM\Column(type="string", length=80)
     */
    private $salt;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255, maxMessage="Le nom de votre ville est trop long.")
     */
    private $town;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Assert\Length(max=15, maxMessage="Il y a trop de caractères dans votre numéro.")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    private $avatar;

    /**
     * @var \UserBundle\Entity\Role
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;

    /**
     * @var \UserBundle\Entity\UserStatus
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\UserStatus")
     * @ORM\JoinColumn(name="user_status_id", referencedColumnName="id")
     */
    private $userStatus;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Badge")
     * @ORM\JoinTable(name="rewards")
     */
    private $badges;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="NAOBundle\Entity\Observation", mappedBy="user")
     */
    private $observations;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="NAOBundle\Entity\Observation")
     * @ORM\JoinTable(name="bookmarks")
     */
    private $favoriteObservations;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->observations = new ArrayCollection();
        $this->favoriteObservations = new ArrayCollection();
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @return UserStatus
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * @param UserStatus $userStatus
     */
    public function setUserStatus(UserStatus $userStatus)
    {
        $this->userStatus = $userStatus;
    }

    /**
     * @return ArrayCollection|Badge[]
     */
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * @param Badge $badge
     */
    public function addBadge(Badge $badge)
    {
        if (!$this->badges->contains($badge)){
            $this->badges[] = $badge;
        }
    }

    /**
     * @param Badge $badge
     */
    public function removeBadge(Badge $badge)
    {
        $this->badges->removeElement($badge);
    }

    /**
     * @return ArrayCollection|Observation[]
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param Observation $observation
     */
    public function addObservation(Observation $observation)
    {
        $this->observations[] = $observation;
        $observation->setUser($this);
    }

    /**
     * @param Observation $observation
     */
    public  function removeObservation(Observation $observation)
    {
        $this->observations->removeElement($observation);
        $observation->setUser(null);
    }

    /**
     * @return ArrayCollection|Observation[]
     */
    public function getFavoriteObservations()
    {
        return $this->favoriteObservations;
    }

    /**
     * @param Observation $observation
     */
    public function addFavoriteObservation(Observation $observation)
    {
        if (!$this->favoriteObservations->contains($observation)){
            $this->favoriteObservations[] = $observation;
        }
    }

    /**
     * @param Observation $observation
     */
    public function removeFavoriteObservation(Observation $observation)
    {
        $this->favoriteObservations->removeElement($observation);
    }
}