<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobOffer;
use App\Entity\JobTitle;
use App\Entity\JobType;
use App\Entity\Recruiter;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<a href="/" style="color: inherit; text-decoration: none;">Luxury Services</a>')
            ->setFaviconPath('img/luxury-services-logo.png')

        ;
    }

    public function configureMenuItems(): iterable
    {

        // Faire un $this->getUser()->getRole() pour récuperer les infos du user et après faire un affichage en fonction du role

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-tachometer-alt');

        yield MenuItem::section('Jobs');
        yield MenuItem::linkToCrud('JobsTitles', 'fas fa-briefcase', JobTitle::class)->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('JobsType', 'fas fa-briefcase', JobType::class)->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('JobsOffers', 'fas fa-briefcase', JobOffer::class);


        yield MenuItem::section('Candidates')->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('Genders', 'fas fa-venus-mars', Gender::class)->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('Experiences', 'fas fa-hourglass', Experience::class)->setPermission("ROLE_ADMIN");


        yield MenuItem::section('Users')->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('users', 'fas fa-user-tie', User::class)->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('candidates', 'fas fa-user-tie', Candidate::class)->setPermission("ROLE_ADMIN");
        yield MenuItem::linkToCrud('recruiters', 'fas fa-user-tie', Recruiter::class)->setPermission("ROLE_ADMIN");
    }
}
