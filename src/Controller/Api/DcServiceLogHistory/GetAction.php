<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceLogHistory;

use App\Dto\Response\ResponseDto;
use App\Entity\DcServiceLogHistory;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcServiceLogHistory\Getter;
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
    public function __construct(
        private readonly Getter $getter,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route(
        '/dcServiceLogHistory/id/{id}',
        name: 'GetDcServiceLogHistory',
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
                                ref: new Model(type: DcServiceLogHistory::class)
                            ),
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'DcServiceLogHistory')]
    public function __invoke(int $id): ApiResponse
    {
        /** @var DcServiceLogHistory[] $list */
        $list = $this->getter->getByServiceId($id);

        return $this->responseBuilder->data($list);
    }
}
