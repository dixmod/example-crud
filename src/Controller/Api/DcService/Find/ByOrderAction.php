<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Request\Find\Service\ByOrdersDto;
use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
use Exception;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ByOrder
 * @package App\Controller\Api\DcService\Find
 */
class ByOrderAction extends BaseFind
{
    /**
     * @param ByOrdersDto $request
     * @return ApiResponse
     * @throws Exception
     */
    #[Route(
        '/dcService/find/byOrder',
        name: 'GetDcServiceFindByOrder',
        methods: ['POST']
    )]
    #[RequestBody(content: new Model(type: ByOrdersDto::class))]
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
                            type: 'array',
                            items: new Items(
                                ref: new Model(type: DcService::class),
                            )
                        )
                    ]
                )
            ]
        )
    )]
    public function __invoke(#[MapRequestPayload] ByOrdersDto $request): ApiResponse
    {
        $entities = $this->getGetter()->findByOrder($request);

        return $this->getResponseBuilder()->data($entities);
    }
}
