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
        for ($i = 0; $i < 5; $i++) {
            $album = new Album();
            $album->setName('Album -' . $i);
            $manager->persist($album);
            $max = $i === 0 ? 5 : 21;
            for ($n = 0; $n < $max; $n++) {
                $image = new Image();
                $image->setName('Img- ' . $n . 'Album- ' . $i);
                $image->setAlbum($album);
                $manager->persist($image);
            }
        }
        $manager->flush();
    }
}