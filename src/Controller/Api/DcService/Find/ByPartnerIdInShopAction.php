<?php

declare(strict_types=1);

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
 * Class ByPartnerIdInShopAction
 * @package App\Controller\Api\DcService\Find
 */
class ByPartnerIdInShopAction extends BaseFind
{
    /**
     * @param int $partnerId
     * @param int $shopId
     * @return ApiResponse
     */
    #[Route(
        '/dcService/find/byPartnerIdInShop/{partnerId}/{shopId}',
        name: 'GetDcServiceFindByPartnerIdInShop',
        requirements: ['partnerId' => '\d+', 'shopId' => '\d+'],
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
    public function __invoke(int $partnerId, int $shopId): ApiResponse
    {
        $entity = $this->getGetter()->findByPartnerIdInShop($partnerId, $shopId);

        return $this->getResponseBuilder()->data($entity);
    }
}
