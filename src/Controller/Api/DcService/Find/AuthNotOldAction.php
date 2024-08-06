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
 * Class AuthNotOld
 * @package App\Controller\Api\DcService\Find
 */
class AuthNotOldAction extends BaseFind
{
    /**
     * @param int $notBankId
     * @param int $notOldDays
     * @return ApiResponse
     * @throws NotFoundException
     */
    #[Route(
        '/dcService/find/authNotOld/{notBankId}/{notOldDays}',
        name: 'GetDcServiceFindAuthNotOld',
        requirements: ['notBankId' => '\d+', 'notOldDays' => '\d+'],
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
    public function __invoke(int $notBankId, int $notOldDays): ApiResponse
    {
        $entity = $this->getGetter()->findAuthNotOld($notBankId, $notOldDays);

        return $this->getResponseBuilder()->data($entity);
    }
}
