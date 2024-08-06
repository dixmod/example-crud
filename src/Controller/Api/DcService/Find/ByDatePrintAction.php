<?php

namespace App\Controller\Api\DcService\Find;

use App\Dto\Response\ResponseDto;
use App\Entity\DcService;
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
 * Class ByDatePrintAction
 * @package App\Controller\Api\DcService\Find
 */
class ByDatePrintAction extends BaseFind
{
    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $order
     * @return ApiResponse
     */
    #[Route(
        '/dcService/find/byDatePrint/{dateFrom}/{dateTo}/{order}',
        name: 'GetDcServiceFindByDatePrint',
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
    public function __invoke(string $dateFrom, string $dateTo, string $order): ApiResponse
    {
        $entities = $this->getGetter()->findByDatePrint($dateFrom, $dateTo, $order);

        return $this->getResponseBuilder()->data($entities);
    }
}
