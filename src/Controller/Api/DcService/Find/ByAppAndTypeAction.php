<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use App\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ByAppAndTypeAction
 * @package App\Controller\Api\DcService\Find
 */
class ByAppAndTypeAction extends BaseFind
{
    /**
     * @param int $appId
     * @param int $notBankId
     * @return ApiResponse
     * @throws NotFoundException
     */
    #[Route(
        '/dcService/find/byAppAndType/{appId}/{notBankId}',
        name: 'GetDcServiceFindByAppAndType',
        requirements: ['appId' => '\d+', 'notBankId' => '\d+'],
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
    public function __invoke(int $appId, int $notBankId): ApiResponse
    {
        $entities = $this->getGetter()->findByAppAndType($appId, $notBankId);

        return $this->getResponseBuilder()->data($entities);
    }
}
