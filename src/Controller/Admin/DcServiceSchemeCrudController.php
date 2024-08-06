<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceScheme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceSchemeCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(actions: [Action::INDEX], path: self::PATH_TO_DC_SERVICE_SCHEME)]
class DcServiceSchemeCrudController extends CustomCrudController
{
    public const PATH_TO_DC_SERVICE_SCHEME = 'dcServiceScheme';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceScheme::class;
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
            IdField::new(DcServiceScheme::PROPERTY_ID),
            TextField::new(DcServiceScheme::PROPERTY_SCHEME_NAME),
            TextField::new(DcServiceScheme::PROPERTY_XML_ID),
        ];
    }
}
