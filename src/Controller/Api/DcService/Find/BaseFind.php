<?php

namespace App\Controller\Api\DcService\Find;

use App\Response\ApiResponseBuilder;
use App\Service\DcService\Getter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BaseFind
 * @package App\Controller\Api\DcService\Find
 */
class BaseFind extends AbstractController
{
    /**
     * @param Getter $getter
     * @param ApiResponseBuilder $responseBuilder
     */
    public function __construct(
        private readonly Getter $getter,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    /**
     * @return Getter
     */
    public function getGetter(): Getter
    {
        return $this->getter;
    }

    /**
     * @return ApiResponseBuilder
     */
    public function getResponseBuilder(): ApiResponseBuilder
    {
        return $this->responseBuilder;
    }
}
