<?php
namespace GalleryBundle\DataFixtures\ORM;
use GalleryBundle\Entity\Album;
use GalleryBundle\Entity\Image;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
class LoadAlbumsImages implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 6; $i++) {
            $album = new Album();
            $album->setName('Album -' . $i);
            $manager->persist($album);
            $max = $i === 1 ? 6 : 22;
            for ($n = 1; $n < $max; $n++) {
                $image = new Image();
                $image->setName('name-' . $i . $n );
                $image->setImage('Image-' . $i . $n);
                $image->setAlbums($album);
                $manager->persist($image);
            }
        }
        $manager->flush();
    }
}