<?php
/**
 * User Entity
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="users", uniqueConstraints={@UniqueConstraint(name="usercon", columns={"username"})})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * Auto-incremented integer for location id.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * Username of the user.
     * @ORM\Column(type="string", unique=true)
     */
    private $username;
    /**
     * Password of the user.
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * Roles of the user.
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * Returns the id of a generated row.
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the username of a generated row.
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username of a generated row.
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * Returns the password of a generated row.
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password of a generated row.
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the roles of a generated row.
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the roles of a generated role.
     * @param $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns whether the user has admin authentication.
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roles[0] == "ROLE_ADMIN";
    }

    /**
     * Return salt.
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Erase credentials.
     */
    public function eraseCredentials()
    {

    }

    /** @see \Serializable::serialize() */
    /**
     * Return values as a serialised array.
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    /**
     * Unserialise values.
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }
}