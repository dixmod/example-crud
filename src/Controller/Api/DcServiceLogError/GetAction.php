<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceLogError;

use App\Dto\Response\ResponseDto;
use App\Entity\DcServiceLogError;
use App\Entity\DcServiceLogHistory;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcServiceLogError\Getter;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
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

    #[Route(
        '/dcServiceLogError/id/{id}',
        name: 'GetDcServiceLogError',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
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
                            type: 'array',
                            items: new Items(
                                ref: new Model(type: DcServiceLogError::class)
                            ),
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'DcServiceLogError')]
    public function __invoke(int $id): ApiResponse
    {
        /** @var DcServiceLogError[] $list */
        $list = $this->getter->getByServiceId($id);

        return $this->responseBuilder->data($list);
    }
}
