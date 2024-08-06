<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Request\Find\Service\IdsDto;
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
 * Class ByIds
 * @package App\Controller\Api\DcService\Find
 */
class ByIdsAction extends BaseFind
{
    /**
     * @param IdsDto $request
     * @return ApiResponse
     * @throws Exception
     */
    #[Route(
        '/dcService/find/byIds',
        name: 'GetDcServiceFindByByIds',
        methods: ['POST']
    )]
    #[RequestBody(content: new Model(type: IdsDto::class))]
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
    public function __invoke(#[MapRequestPayload] IdsDto $request): ApiResponse
    {
        $entities = $this->getGetter()->findByIds($request->getIds());

        return $this->getResponseBuilder()->data($entities);
    }
}
