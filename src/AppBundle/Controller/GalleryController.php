<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     */
    public function indexAction()
    {
        $image = '1200px-Summer-3106910_1920.jpg';

        return $this->render('gallery/index.html.twig', [
            'images'=>[
                $image,
                $image,
                $image,
                $image,
            ]
        ]);
    }
}
