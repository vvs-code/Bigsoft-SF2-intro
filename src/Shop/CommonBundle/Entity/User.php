<?php
namespace Shop\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    const SALT = 'SOME_SALT';

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")`
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $_id
     */
    private $_id;
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
    private $_password;

    /**
     *
     */
    public function __construct($name = null, $pass = null)
    {
        if (!is_null($name)) {
            $this->setUsername($name);
        }
        if (!is_null($pass)) {
            $this->setRawPassword($pass);
        }
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
        if ($this->getId()) {
            $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
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
     * Set password hash
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * Set raw ( not encoded ) password
     * @param string $password
     */
    public function setRawPassword($password)
    {
        $this->_password = static::encodePassword($password);
        return $this;
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
        return static::SALT;
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

    public static function encodePassword($pass) {
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        return $encoder->encodePassword($pass, static::SALT);
    }
}
