<?php
namespace Shop\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role implements RoleInterface, \Serializable
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string $name
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getRole()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return \json_encode([$this->name, $this->id]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list($this->name, $this->id) = \json_decode($serialized);
    }
}
