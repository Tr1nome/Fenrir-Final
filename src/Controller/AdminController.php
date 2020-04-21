<?php
namespace App\Controller;

use App\Repository\FormationRepository;
use App\Repository\NewsRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(UserRepository $userRepository, FormationRepository $formationRepository, ProjectRepository $projectRepository, NewsRepository $newsRepository)
    {
        return $this->render('admin/admin.html.twig', [
            'users'=> $userRepository->findAll(),
            'formations'=> $formationRepository->findAll(),
            'newformations'=> $formationRepository->findBy(['createdAt' => new DateTime('now')]),
            'projects'=> $projectRepository->findAll(),
            'news'=> $newsRepository->findAll()
        ]);

    }
}