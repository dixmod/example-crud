<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceLogHistory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceLogHistoryCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(path: self::PATH_DC_SERVICE_LOG_HISTORY)]
class DcServiceLogHistoryCrudController extends CustomCrudController
{
    public const PATH_DC_SERVICE_LOG_HISTORY = 'dcServiceLogHistory';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceLogHistory::class;
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
     * @param Filters $filters
     * @return Filters
     */
    final public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(DcServiceLogHistory::PROPERTY_SERVICE_ID);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            IdField::new(DcServiceLogHistory::PROPERTY_ID),
            AssociationField::new(DcServiceLogHistory::PROPERTY_SERVICE),
            TextEditorField::new(DcServiceLogHistory::PROPERTY_HISTORY_VALUE),
            DateTimeField::new(DcServiceLogHistory::PROPERTY_CREATED_AT),
        ];
    }
}
