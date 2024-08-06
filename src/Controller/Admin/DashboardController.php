<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceScheme;
use App\Entity\DcService;
use App\Entity\DcServiceBarcode;
use App\Entity\DcServiceDeviceType;
use App\Entity\DcServiceLogError;
use App\Entity\DcServiceLogHistory;
use App\Entity\DcServiceParam;
use App\Entity\DcServiceStatus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use MarcinJozwikowski\EasyAdminPrettyUrls\Controller\PrettyDashboardController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 */
class DashboardController extends PrettyDashboardController
{
    public const ICON_LIST = 'fas fa-list';
    public const TITLE = 'Additional Product Store';

    /**
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(DcServiceCrudController::class)->generateUrl());
    }

    /**
     * @return Dashboard
     */
    final public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle(self::TITLE);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @return iterable
     */
    final public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud(DcService::ENTITY_TITLE, self::ICON_LIST, DcService::class);
        yield MenuItem::linkToCrud(DcServiceStatus::ENTITY_TITLE, self::ICON_LIST, DcServiceStatus::class);
        yield MenuItem::linkToCrud(DcServiceDeviceType::ENTITY_TITLE, self::ICON_LIST, DcServiceDeviceType::class);
        yield MenuItem::linkToCrud(DcServiceLogError::ENTITY_TITLE, self::ICON_LIST, DcServiceLogError::class);
        yield MenuItem::linkToCrud(DcServiceLogHistory::ENTITY_TITLE, self::ICON_LIST, DcServiceLogHistory::class);
        yield MenuItem::linkToCrud(DcServiceParam::ENTITY_TITLE, self::ICON_LIST, DcServiceParam::class);
        yield MenuItem::linkToCrud(DcServiceBarcode::ENTITY_TITLE, self::ICON_LIST, DcServiceBarcode::class);
        yield MenuItem::linkToCrud(DcServiceScheme::ENTITY_TITLE, self::ICON_LIST, DcServiceScheme::class);
    }
}
