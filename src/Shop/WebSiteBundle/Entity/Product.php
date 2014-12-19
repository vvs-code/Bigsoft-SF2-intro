<?php
namespace Shop\WebSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\WebSiteBundle\Entity\ProductRepository")
 * @ORM\Table(name="product")
 */
Class Product implements \Serializable
{
    /**
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getDecription()
    {
        return $this->decription;
    }

    /**
     * @param string $decription
     */
    public function setDecription($decription)
    {
        $this->decription = $decription;
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
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
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
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")`
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;
    /**
     * @ORM\Column(name="image", type="string", length=255)
     *
     * @var string $image
     */
    private $image;
    /**
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @var string $title
     */
    private $title;
    /**
     * @ORM\Column(name="description", type="text")
     *
     * @var string $title
     */
    private $decription;
    /**
     * @ORM\Column(name="price", type="integer")
     *
     * @var string $price
     */
    private $price;
    /**
     * @ORM\Column(name="categories", type="array")
     *
     * @var string $categories
     */
    private $categories = array();

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
                $this->decription,
                json_encode($this->categories)
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
        $this->categories = \json_decode($this->categories);
    }
}
