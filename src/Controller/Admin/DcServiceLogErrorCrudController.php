<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceLogError;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceLogErrorCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(path: self::PATH_TO_DC_SERVICE_LOG_ERROR)]
class DcServiceLogErrorCrudController extends CustomCrudController
{
    public const PATH_TO_DC_SERVICE_LOG_ERROR = 'dcServiceLogError';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceLogError::class;
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
            Action::EDIT,
            Action::DELETE
        );
    }

    /**
     * @param Filters $filters
     * @return Filters
     */
    final public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(DcServiceLogError::PROPERTY_SERVICE_ID);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            IdField::new(DcServiceLogError::PROPERTY_ID),
            AssociationField::new(DcServiceLogError::PROPERTY_SERVICE),
            TextEditorField::new(DcServiceLogError::PROPERTY_ERROR_VALUE),
            DateTimeField::new(DcServiceLogError::PROPERTY_CREATED_AT),
        ];
    }
}
