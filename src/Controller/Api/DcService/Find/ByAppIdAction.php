<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ByAppIdAction
 * @package App\Controller\Api\DcService\Find
 */
class ByAppIdAction extends BaseFind
{
    /**
     * @param int $appId
     * @return ApiResponse
     */
    #[Route(
        '/dcService/find/byAppId/{appId}',
        name: 'GetDcServiceFindByAppId',
        requirements: ['appId' => '\d+',],
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
    public function __invoke(int $appId): ApiResponse
    {
        $entity = $this->getGetter()->findByAppId($appId);

        return $this->getResponseBuilder()->data($entity);
    }
}
