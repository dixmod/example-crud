<?php

namespace App\Controller\Admin;

use App\Entity\DcServiceParam;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 * Class DcServiceParamCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(path: self::PATH_DC_SERVICE_PARAM)]
class DcServiceParamCrudController extends CustomCrudController
{
    public const PATH_DC_SERVICE_PARAM = 'dcServiceParam';

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcServiceParam::class;
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    final public function configureCrud(Crud $crud): Crud
    {
        return
            $crud->setPageTitle(Crud::PAGE_DETAIL, 'DcServiceParam')
            ->setPageTitle(Crud::PAGE_EDIT, '');
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
        return $filters->add('serviceId');
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        return [
            TextField::new(DcServiceParam::PROPERTY_SIGN_TYPE_SELECTED),
            TextField::new(DcServiceParam::PROPERTY_SIGN_TYPE_ALLOW),
            TextField::new(DcServiceParam::PROPERTY_CUSTOM_SERVICE_DATA),
            IntegerField::new(DcServiceParam::PROPERTY_SMSCODE_COUNT_SEND),
            IntegerField::new(DcServiceParam::PROPERTY_SMSCODE_COUNT_CAN_SEND),
            IntegerField::new(DcServiceParam::PROPERTY_SMSCODE_COUNT_CHECK),
            IntegerField::new(DcServiceParam::PROPERTY_SMSCODE_COUNT_CAN_CHECK),
        ];
    }
}
