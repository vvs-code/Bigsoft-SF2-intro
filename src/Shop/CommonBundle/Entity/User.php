<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    const DEFAULT_SALT = 'SOME_SALT';
    const DEFAULT_PASSWORD = 'demo';

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $_id
     */
    private $_id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @ORM\Column(name="username", type="string", length=255)
     *
     * @var string $_username
     */
    private $_username = "";

    /**
     * @ORM\Column(name="password", type="string", length=255)
     *
     * @var string $_password
     */
    private $_password = "";


    /**
     * @ORM\Column(name="salt", type="string", length=255)
     *
     * @var string $_salt
     */
    private $_salt = "";

    /**
     *
     */
    public function __construct($name = '', $pass = DEFAULT_PASSWORD, $salt = DEFAULT_SALT)
    {
        $this->_username = $name;
        $this->_password = $pass;
        $this->_salt = $salt;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        $roles = ['IS_AUTHENTICATED_ANONYMOUSLY'];
        if($this->getId()) {
           $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->_salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Set password
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->_salt = $salt;
        return $this;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
