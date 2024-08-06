<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceBarcode;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 *  Class DcServiceBarcodeCrudController
 *  @package App\Controller\Admin
 */
#[PrettyRoutesController(path: self::PATH_DC_SERVICE_BARCODE)]
class DcServiceBarcodeCrudController extends CustomCrudController
{
    public const PATH_DC_SERVICE_BARCODE = 'dcServiceBarcode';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceBarcode::class;
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
            Action::DELETE
        );
    }

    /**
     * @param Filters $filters
     * @return Filters
     */
    final public function configureFilters(Filters $filters): Filters
    {
        return $filters->add(DcServiceBarcode::PROPERTY_SERVICE_ID);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            IdField::new(DcServiceBarcode::PROPERTY_ID)->setDisabled(),
            AssociationField::new(DcServiceBarcode::PROPERTY_SERVICE)->hideOnForm(),
            TextField::new(DcServiceBarcode::PROPERTY_BARCODE),
        ];
    }
}
