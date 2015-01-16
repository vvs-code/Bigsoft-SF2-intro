<?php
namespace Shop\WebSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Shop\WebSiteBundle\Entity\ProductRepository")
 * @ORM\Table(name="product")
 */
Class Product implements \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")`
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;
    /**
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\NotBlank(message="Product should contains picture")
     *
     * @var string $image
     */
    private $image;
    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Product should contains title")
     *
     * @var string $title
     */
    private $title;
    /**
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="Product should contains description")
     *
     * @var string $description
     */
    private $description;
    /**
     * @ORM\Column(name="price", type="integer")
     * @Assert\NotBlank(message="Product should contains price")
     *
     * @var integer $price
     */
    private $price;

    /**
     *  @Assert\Image()
     *
     * @var
     */
    private $file;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $decription
     */
    public function setDescription($decription)
    {
        $this->description = $decription;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @inheritDoc
     */
    public function serialize()
    {
        return \json_encode([
            $this->id,
            $this->image,
            $this->title,
            $this->price,
            $this->description
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        $arr = \json_decode($serialized);
        foreach ($arr as $key => $val) {
            $this->$key = $val;
        }
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }
}
