<?php
namespace App\Controller;

use App\Repository\FormationRepository;
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
    public function index(NewsRepository $newsRepo, FormationRepository $formationRepo)
    {
        return $this->render('default/index.html.twig', [
            'featuredNew'=> $newsRepo->findOneBy(['isFirst'=> true]),
            'news'=> $newsRepo->findBy(['isFirst'=> false]),
            'formations'=> $formationRepo->findAll()
        ]);

    }

    /**
     * @Route("/formations", name="formations_front")
     */
    public function getFormations(NewsRepository $newsRepo, FormationRepository $formationRepo)
    {
        return $this->render('formation/front_view.html.twig', [
            'formations'=> $formationRepo->findBy(['style' => [1,2,3]]),
            'pastformations'=> $formationRepo->findBy(['style' => 4])
        ]);

    }
}