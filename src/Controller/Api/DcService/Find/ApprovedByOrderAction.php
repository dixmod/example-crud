<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Request\Find\Service\ApprovedByOrderDto;
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
 * Class ApprovedByOfflineOrder
 * @package App\Controller\Api\DcService\Find
 */
class ApprovedByOrderAction extends BaseFind
{
    /**
     * @param ApprovedByOrderDto $request
     * @return ApiResponse
     */
    #[Route(
        '/dcService/find/approvedByOrder',
        name: 'GetDcServiceFindApprovedByOrder',
        methods: ['POST']
    )]
    #[RequestBody(content: new Model(type: ApprovedByOrderDto::class))]
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
    #[Tag(name: 'DcService')]
    public function __invoke(#[MapRequestPayload] ApprovedByOrderDto $request): ApiResponse
    {
        $entities = $this->getGetter()->findStatusByOrder(
            $request->getOrderId(),
            DcService::APPROVED,
            $request->getExcludeIds()
        );

        return $this->getResponseBuilder()->data($entities);
    }
}
