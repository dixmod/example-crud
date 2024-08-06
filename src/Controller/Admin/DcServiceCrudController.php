<?php

namespace App\Controller\Admin;

use App\Entity\DcService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;

/**
 *  Class DcServiceCrudController
 *  @package App\Controller\Admin
 */
#[PrettyRoutesController(path: self::PATH_TO_DC_SERVICE)]
class DcServiceCrudController extends CustomCrudController
{
    public const PATH_TO_DC_SERVICE = 'dcService';
    public const TAB_INFORMATION = 'Базовая информация';
    public const TAB_PROPERTY_VALUE = 'Значения свойств';
    public const TAB_LOG_OPTION = 'Логи и дополнительные параметры';
    public const  PRICE_NUM_DECIMALS = 4;
    public const DEFAULT_INT_LENGTH = 400;

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return DcService::class;
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
        return $actions
            ->disable(Action::NEW, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_EDIT, Action::DETAIL);
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    final public function configureCrud(Crud $crud): Crud
    {
        return
            parent::configureCrud($crud)
                ->setSearchFields([DcService::PROPERTY_ID])
                ->setDefaultSort([DcService::PROPERTY_CREATED_AT => 'DESC']);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param Filters $filters
     * @return Filters
     */
    final public function configureFilters(Filters $filters): Filters
    {
        return
            $filters->add(DcService::PROPERTY_CREATED_AT)
            ->add(DcService::PROPERTY_MODIFIED_AT)
            ->add(DcService::PROPERTY_ORDER_ID)
            ->add(DcService::PROPERTY_APPLICATION_ID)
            ->add(DcService::PROPERTY_SHOP_ID)
            ->add(DcService::PROPERTY_AGENT_ID)
            ->add(DcService::PROPERTY_USER_ID)
            ->add(DcService::PROPERTY_PROFILE_ID)
            ->add(DcService::PROPERTY_INSURANCENOTBANK_ID)
            ->add(EntityFilter::new(DcService::PROPERTY_SERVICE_STATUS));
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    final public function defineFields(string $pageName): iterable
    {
        $labels = DcService::labels();

        return [
            FormField::addTab(self::TAB_INFORMATION),
            FormField::addFieldset(''),
            IdField::new(DcService::PROPERTY_ID)
                ->setDisabled()
                ->setMaxLength(self::DEFAULT_INT_LENGTH)->setCssClass('js-row-action'),
            BooleanField::new(DcService::PROPERTY_ACTIVE, $labels[DcService::PROPERTY_ACTIVE])->hideOnIndex(),
            TextField::new(DcService::PROPERTY_SERVICE_NAME),
            IdField::new(DcService::PROPERTY_INSURANCENOTBANK_ID)
                ->setMaxLength(self::DEFAULT_INT_LENGTH),
            TextField::new(DcService::PROPERTY_CODE)->hideOnIndex(),

            FormField::addFieldset(self::TAB_PROPERTY_VALUE),
            IdField::new(DcService::PROPERTY_ORDER_ID)
                ->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_APPLICATION_ID)
                ->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_INSURANCENOTBANK_ID)
                ->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_BANK_ID)
                ->hideOnIndex()
                ->setMaxLength(self::DEFAULT_INT_LENGTH),

            AssociationField::new(DcService::PROPERTY_SERVICE_STATUS)
                ->setTemplateName(self::CRUD_TEMPLATE_FIELD_TEXT),
            NumberField::new(DcService::PROPERTY_PRICE)
                ->setNumDecimals(self::PRICE_NUM_DECIMALS)->hideOnIndex(),

            IdField::new(DcService::PROPERTY_SHOP_ID)->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_STORE_ID)->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_AGENT_ID)->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_USER_ID)->setMaxLength(self::DEFAULT_INT_LENGTH),
            IdField::new(DcService::PROPERTY_PROFILE_ID)->setMaxLength(self::DEFAULT_INT_LENGTH),

            DateTimeField::new(DcService::PROPERTY_CREATED_AT)->hideWhenUpdating(),
            IdField::new(DcService::PROPERTY_CREATED_BY)->onlyOnDetail(),
            DateTimeField::new(DcService::PROPERTY_MODIFIED_AT)->hideWhenUpdating(),
            IdField::new(DcService::PROPERTY_MODIFIED_BY)->onlyOnDetail(),

            TextField::new(DcService::PROPERTY_SMS_CODE)->hideOnIndex(),
            IntegerField::new(DcService::PROPERTY_COUNT_SEND_CODE)->hideOnIndex(),
            IntegerField::new(DcService::PROPERTY_COUNT_CHECK_CODE)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_GET_CODE)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SEND_CODE)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_CHECK_CODE)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SEND)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_RESPONSE)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SEND_CONFIRM)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_RESPONSE_CONFIRM)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_PRINT)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SIGN)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SEND_SCAN)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_RESPONSE_SCAN)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_SEND_SIGN)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_REGISTER)->hideOnIndex(),
            DateTimeField::new(DcService::PROPERTY_DATE_CANCEL)->hideOnIndex(),

            TextField::new(DcService::PROPERTY_CONTRACT_FILE)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CONTRACT_NUMBER)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CONTRACT_NUMBER_HASH)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_ACCOUNT_NUMBER)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_ADD_ID)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_ADD_ID_2)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CARD_NUMBER)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CARD_EXPIRY)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_BARCODE)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CONFIRM_CODE)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_DESIRED_CREDIT_LIMIT)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CREDIT_LIMIT)->hideOnIndex(),
            IdField::new(DcService::PROPERTY_CHANGES_REASON_ID)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_S_NAME)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_CLIENT_TEL)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_USLUGA_TEL)->hideOnIndex(),
            AssociationField::new(DcService::PROPERTY_SCHEME_NAME)
                ->hideOnIndex(),
            IdField::new(DcService::PROPERTY_ID_PARTNER)->hideOnIndex(),
            NumberField::new(DcService::PROPERTY_PRICE_WITH_SALE)
                ->setNumDecimals(self::PRICE_NUM_DECIMALS)
                ->hideOnIndex(),
            IdField::new(DcService::PROPERTY_INSURE_PROFILE_ID)->hideOnIndex(),
            AssociationField::new(DcService::PROPERTY_INSURE_DEVICE_TYPE)->onlyOnDetail(),
            TextField::new(DcService::PROPERTY_INSURE_DEVICE_MODEL)->hideOnIndex(),
            TextField::new(DcService::PROPERTY_INSURE_DEVICE_SERIAL)->hideOnIndex(),

            FormField::addTab(self::TAB_LOG_OPTION)->onlyOnDetail(),
            ArrayField::new(DcService::PROPERTY_SERVICE_LOG_ERRORS)->onlyOnDetail(),
            ArrayField::new(DcService::PROPERTY_SERVICE_LOG_HISTORY)->onlyOnDetail(),
            TextField::new(DcService::PROPERTY_SERVICE_PARAMS)->onlyOnDetail(),
            ArrayField::new(DcService::PROPERTY_SERVICE_BARCODE)->onlyOnDetail(),
        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        $assets = parent::configureAssets($assets);
        $assets->addJsFile('js/row-clickable.js');

        return $assets;
    }
}
