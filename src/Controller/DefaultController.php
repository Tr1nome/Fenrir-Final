<?php
namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/", name="main")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(NewsRepository $newsRepo)
    {
        return $this->render('default/index.html.twig', [
            'featuredNew'=> $newsRepo->findOneBy(['isFirst'=> true]),
            'news'=> $newsRepo->findBy(['isFirst'=> false])
        ]);

    }
}