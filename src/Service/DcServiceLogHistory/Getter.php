<?php

declare(strict_types=1);

namespace App\Service\DcServiceLogHistory;

use App\Repository\DcServiceLogHistoryRepository;
use App\Service\BaseGetter;

/**
 * Class Getter
 */
class Getter extends BaseGetter
{
    public function __construct(
        protected DcServiceLogHistoryRepository $repository
    ) {
        $this->commonRepository = $this->repository;
    }
}
