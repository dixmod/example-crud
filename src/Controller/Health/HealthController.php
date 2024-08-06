<?php

namespace App\Controller\Health;

use App\Dto\Health\Response\LivenessSuccessResponse;
use App\Dto\Health\Response\ReadnessSuccessResponse;
use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\HealthChecker;
use Doctrine\ORM\NonUniqueResultException;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HealthController
 * @package App\Controller
 */
class HealthController extends AbstractController
{
    public function __construct(
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    /**
     * @return ApiResponse
     */
    #[Route('/l', methods: ['GET'])]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(
            allOf: [
                new Schema(ref: new Model(type: ResponseDto::class)),
                new Schema(
                    properties: [
                        new Property(
                            property: 'data',
                            ref: new Model(type: LivenessSuccessResponse::class),
                            type: 'object'
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'Health')]
    public function liveness(): ApiResponse
    {
        return $this->responseBuilder->data(new LivenessSuccessResponse(true));
    }

    /**
     * @param HealthChecker $settingsResolver
     * @return ApiResponse
     * @throws NonUniqueResultException
     */
    #[Route('/r', methods: ['GET'])]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(
            allOf: [
                new Schema(ref: new Model(type: ResponseDto::class)),
                new Schema(
                    properties: [
                        new Property(
                            property: 'data',
                            ref: new Model(type: ReadnessSuccessResponse::class),
                            type: 'object'
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'Health')]
    public function readness(
        HealthChecker $settingsResolver
    ): ApiResponse {
        $service = $settingsResolver->checkDb();
        $redisCheck = $settingsResolver->checkRedis();
        $redisSessionCheck = $settingsResolver->checkSessionRedis();

        if (!$service instanceof DcService) {
            return $this->responseBuilder->error([], 1, 'db not fully ready', 404);
        }

        $env = $this->getParameter('kernel.environment');

        return $this->responseBuilder->data(new ReadnessSuccessResponse(
            $env,
            true,
            $redisCheck,
            $redisSessionCheck
        ));
    }
}
