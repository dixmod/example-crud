<?php

namespace App\Controller\Admin;

use App\Entity\DescribeLabelsInterface;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use MarcinJozwikowski\EasyAdminPrettyUrls\Attribute\PrettyRoutesController;
use ReflectionClass;
use ReflectionException;

/**
 * Class CustomCrudController
 * @package App\Controller\Admin
 */
#[PrettyRoutesController(actions: [], path: 'custom_crud')]
abstract class CustomCrudController extends AbstractCrudController
{
    public const CRUD_TEMPLATE_FIELD_TEXT = 'crud/field/text';

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param string $pageName
     * @return iterable
     */
    abstract public function defineFields(string $pageName): iterable;

    /**
     * @param string $pageName
     * @return iterable
     * @throws ReflectionException
     */
    public function configureFields(string $pageName): iterable
    {
        $fields = $this->defineFields($pageName);
        return $this->addFieldsLabels($fields);
    }

    /**
     * @param FieldInterface[] $fields
     * @return FieldInterface[]
     * @throws ReflectionException
     */
    private function addFieldsLabels(iterable $fields): iterable
    {
        $reflect = new ReflectionClass(static::getEntityFqcn());
        if (!$reflect->implementsInterface(DescribeLabelsInterface::class)) {
            return $fields;
        }

        $labels = call_user_func([static::getEntityFqcn(), 'labels']);
        foreach ($fields as $field) {
            $dto = $field->getAsDto();

            if (null === $dto->getLabel()) {
                $label = $this->newLabel($labels, $dto->getProperty());
                $field->setLabel($label); //@phpstan-ignore-line
            }
        }
        return $fields;
    }

    /**
     * @param array<string, string> $labels
     * @param string $property
     * @return string|null
     */
    private function newLabel(array $labels, string $property): string|null
    {
        return $labels[$property] ?? null;
    }
}
