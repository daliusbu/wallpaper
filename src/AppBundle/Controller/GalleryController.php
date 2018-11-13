<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $images = [
            'abstract-background-pink.jpg',
                'abstract-black-and-white-wave.jpg',
                'abstract-black-multi-color-wave.jpg',
                'abstract-blue-green.jpg',
                'abstract-blue-line-background.jpg',
                'abstract-red-background-pattern.jpg',
                'abstract-shards.jpeg',
                'abstract-swirls.jpeg',
                'landscape-summer-beach.jpg',
            ];

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $images,
            $request->query->getInt('puslapis', 1)/*page number*/,
            4/*limit per page*/
        );

        dump ($pagination);

        return $this->render('gallery/index.html.twig', [
            'images'=>$pagination,
        ]);
    }
}
