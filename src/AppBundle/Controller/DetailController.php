<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 18.11.13
 * Time: 15.43
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends Controller
{

    /**
     * @Route("/view", name="view")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $image = 'abstract-black-and-white-wave.jpg';

        return $this->render('detail/index.html.twig', [
            'image'=>$image,
        ]);
    }

}