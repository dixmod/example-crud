<?php

namespace App\Controller\Api\DcService\Count;

use App\Controller\Api\DcService\Find\BaseFind;
use App\Dto\Request\Find\Service\ListSearchDto;
use App\Dto\Response\ResponseDto;
use App\Response\ApiResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListSearchAction
 * @package App\Controller\Api\DcService\Find
 */
class CountSearchAction extends BaseFind
{
    /**
     * @param ListSearchDto $request
     * @return ApiResponse
     */
    #[Route(
        '/dcService/count/listSearch',
        name: 'GetDcServiceCountListSearch',
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
                            type: 'int',
                            example: 1,
                        )
                    ]
                )
            ]
        )
    )]
    public function __invoke(#[MapRequestPayload] ListSearchDto $request): ApiResponse
    {
        $getter = $this->getGetter();
        if ($request->getPaginator() !== null) {
            $getter->setOffset($request->getPaginator()->getOffset());
            $getter->setLimit($request->getPaginator()->getLimit());
        }

        $entities = $getter->countListSearch($request);

        return $this->getResponseBuilder()->data($entities);
    }
}
