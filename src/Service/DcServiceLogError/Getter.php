<?php

declare(strict_types=1);

namespace App\Service\DcServiceLogError;

use App\Repository\DcServiceLogErrorRepository;
use App\Service\BaseGetter;

/**
 * Class Getter
 */
class Getter extends BaseGetter
{
    public function __construct(
        protected DcServiceLogErrorRepository $repository
    ) {
        $this->commonRepository = $this->repository;
    }
}
