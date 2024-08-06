<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceStatus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceStatusCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(actions: [Action::INDEX], path: self::PATH_TO_DC_SERVICE_STATUS)]
class DcServiceStatusCrudController extends CustomCrudController
{
    public const PATH_TO_DC_SERVICE_STATUS = 'dcServiceStatus';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceStatus::class;
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
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            IdField::new(DcServiceStatus::PROPERTY_ID),
            TextField::new(DcServiceStatus::PROPERTY_STATUS_NAME),
            TextField::new(DcServiceStatus::PROPERTY_XML_ID),
        ];
    }
}
