<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Response\ResponseDto;
use App\Dto\Response\SuccessCreateDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
use Exception;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ByIds
 * @package App\Controller\Api\DcService\Find
 */
class Last extends BaseFind
{
    /**
     * @return ApiResponse
     * @throws Exception
     */
    #[Route(
        '/dcService/find/last',
        name: 'GetDcServiceFindLast',
        methods: ['GET']
    )]
    #[Tag(name: 'DcService')]
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
    public function __invoke(): ApiResponse
    {
        $service = $this->getGetter()->findLast();

        return $this->getResponseBuilder()->data(new SuccessCreateDto($service->getId()));
    }
}
