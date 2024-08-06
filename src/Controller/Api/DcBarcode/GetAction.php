<?php

declare(strict_types=1);

namespace App\Controller\Api\DcBarcode;

use App\Dto\Response\ResponseDto;
use App\Entity\DcServiceBarcode;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcServiceBarcode\Getter;
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
     */
    public function __construct(
        private readonly Getter $getter,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route(
        '/dcBarcode/id/{id}',
        name: 'GetdcBarcode',
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
                                ref: new Model(type: DcServiceBarcode::class)
                            ),
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'DcBarcode')]
    public function __invoke(int $id): ApiResponse
    {
        /** @var DcServiceBarcode[] $list */
        $list = $this->getter->getByServiceId($id);

        return $this->responseBuilder->data($list);
    }
}
