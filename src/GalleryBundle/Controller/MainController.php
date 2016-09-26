<?php

namespace GalleryBundle\Controller;

use GalleryBundle\Entity\Album;
use GalleryBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine();

        $entities = $em->getRepository('GalleryBundle:Album')->findAll();

        return $this->render('GalleryBundle:Main:index.html.twig', array(
            'albums' => $entities
        ));
    }

    public function showAction($id, $page = 1)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $album = $em->getRepository('GalleryBundle:Album')->find($id);

        $dql   = "SELECT a FROM GalleryBundle:Image a WHERE a.albums = :id";
        $query = $em->createQuery($dql)->setParameters(
            array(
                'id' => $id
            )
        );

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', $page),
            10
        );
        $pagination->setUsedRoute('album_show_page'); /*define the pagination route*/

        $serializedEntity = $this->container->get('serializer')->serialize($album, 'json');

        return new Response($serializedEntity);






//        $images = $albums->getImages()->getValues();
//
//        return $this->render('GalleryBundle:Main:show.html.twig', array(
//            'pagination'    => $pagination,
//            'album'      => $album
//            'images'      => $images
//        ));
    }

    public function getHomePageAction()
    {
        $em = $this->getDoctrine();

        $entities = $em->getRepository('GalleryBundle:Album')->findAll();

        $serializedEntity = $this->container->get('serializer')->serialize($entities, 'json');

        return new Response($serializedEntity);
    }
}
