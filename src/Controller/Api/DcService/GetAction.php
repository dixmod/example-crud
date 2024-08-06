<?php

declare(strict_types=1);

namespace App\Controller\Api\DcService;

use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcService\Getter;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetAction
 */
class GetAction
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

    #[Route('/dcService/id/{id}', name: 'GetDcService', requirements: ['id' => '\d+'], methods: ['GET'])]
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
                            ref: new Model(type: DcService::class),
                            type: 'object',
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'DcService')]
    public function __invoke(int $id): ApiResponse
    {
        $entity = $this->getter->findById($id);

        return $this->responseBuilder->data($entity);
    }
}
