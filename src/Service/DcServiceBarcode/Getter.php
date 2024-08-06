<?php

declare(strict_types=1);

namespace App\Service\DcServiceBarcode;

use App\Repository\DcServiceBarcodeRepository;
use App\Service\BaseGetter;

/**
 * Class Getter
 */
class Getter extends BaseGetter
{
    public function __construct(
        protected DcServiceBarcodeRepository $repository
    ) {
        $this->commonRepository = $this->repository;
    }
}
