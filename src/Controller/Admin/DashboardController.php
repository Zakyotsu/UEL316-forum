<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Report;
use App\Entity\User;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard {
        return Dashboard::new()
            ->setTitle('Admin Zone');
    }

    public function configureMenuItems(): iterable {

        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToUrl('Accueil du Front-end', 'fa -fa-arrow-left', $this->generateUrl('app_home_page')),

            MenuItem::section('Gestion de la base de données'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class),
            MenuItem::linkToCrud('Commentaires', 'fas fa-list', Comment::class),
            MenuItem::linkToCrud('Posts', 'fas fa-list', Post::class),
            MenuItem::linkToCrud('Signalements', 'fas fa-list', Report::class),

            MenuItem::linkToLogout('Déconnexion', 'fa fa-fa fa-sign-out'),
        ];
    }
}
