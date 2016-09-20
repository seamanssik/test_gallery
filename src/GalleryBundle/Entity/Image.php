<?php

namespace GalleryBundle\Entity;

/**
 * Image
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \GalleryBundle\Entity\Album
     */
    private $albums;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set albums
     *
     * @param \GalleryBundle\Entity\Album $albums
     *
     * @return Image
     */
    public function setAlbums(\GalleryBundle\Entity\Album $albums = null)
    {
        $this->albums = $albums;

        return $this;
    }

    /**
     * Get albums
     *
     * @return \GalleryBundle\Entity\Album
     */
    public function getAlbums()
    {
        return $this->albums;
    }
}

