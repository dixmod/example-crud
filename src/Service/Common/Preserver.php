<?php

declare(strict_types=1);

namespace App\Service\Common;

use App\Interfaces\EntityRequestInterface;
use App\Interfaces\EntityResponseInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Preserver
 */
class Preserver
{
    public const START_SETTER = 'set';
    public const START_GETTER = 'get';

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function updateAndSave(EntityResponseInterface $entity, EntityRequestInterface $params): void
    {
        // @TODO: Consider the option of abandoning the universal factory
        $this->fillFields($entity, $params);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    private function fillFields(EntityResponseInterface $entity, EntityRequestInterface $params): void
    {
        $methods = array_values(array_filter(
            get_class_methods($params),
            static fn ($titleMethod) => (str_starts_with($titleMethod, self::START_GETTER))
        ));

        foreach ($methods as $getter) {
            $setter = str_replace(self::START_GETTER, self::START_SETTER, $getter);

            if (false === method_exists($entity, $setter)) {
                continue;
            }

            $value = $params->{$getter}();
            if ($value === null) {
                continue;
            }

            $entity->{$setter}($value);
        }
    }
}
