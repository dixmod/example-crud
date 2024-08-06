<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceDeviceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceDeviceTypeCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(actions: [Action::INDEX], path: self::PATH_TO_DC_SERVICE_DEVICE_TYPE)]
class DcServiceDeviceTypeCrudController extends CustomCrudController
{
    public const PATH_TO_DC_SERVICE_DEVICE_TYPE = 'dcServiceDeviceType';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceDeviceType::class;
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    final public function configureActions(Actions $actions): Actions
    {
        /**
         * https://symfony.com/bundles/EasyAdminBundle/current/actions.html#built-in-actions
         */
        return $actions->disable(
            Action::NEW,
            Action::DETAIL,
            Action::EDIT,
            Action::DELETE
        );
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param Filters $filters
     * @return Filters
     */
    final public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters(Filters::new());
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            IdField::new(DcServiceDeviceType::PROPERTY_ID),
            TextField::new(DcServiceDeviceType::PROPERTY_DEVICE_TYPE_NAME),
            TextField::new(DcServiceDeviceType::PROPERTY_XML_ID),
        ];
    }
}
