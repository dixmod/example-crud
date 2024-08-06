<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Request\Find\Service\ListSearchDto;
use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
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
 * Class ByAgentFilter
 * @package App\Controller\Api\DcService\Find
 */
class ByAgentFilterAction extends BaseFind
{
    /**
     * @param ListSearchDto $request
     * @return ApiResponse
     */
    #[Route(
        '/dcService/find/byAgentFilter',
        name: 'GetDcServiceFindByAgentFilter',
        methods: ['POST']
    )]
    #[RequestBody(content: new Model(type: ListSearchDto::class))]
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
    public function __invoke(#[MapRequestPayload] ListSearchDto $request): ApiResponse
    {
        $entities = $this->getGetter()->findByAgentFilter($request);

        return $this->getResponseBuilder()->data($entities);
    }
}
