<?php

namespace App\Controller\Api\DcBarcode;

use App\Dto\Request\DcBarcodeDto;
use App\Dto\Response\ResponseDto;
use App\Dto\Response\SuccessCreateDto;
use App\Entity\DcServiceBarcode;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\Common\Preserver;
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
 * Class CreateAction
 * @package App\Controller\Api\DcBarcode
 */
class CreateAction
{
    public function __construct(
        private readonly Preserver $creator,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route('/dcBarcode', name: 'CreatedcBarcode', methods: ['POST'])]
    #[RequestBody(content: new Model(type: DcBarcodeDto::class))]
    #[Tag(name: 'DcBarcode')]
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
                            ref: new Model(type: SuccessCreateDto::class),
                            type: 'object',
                        )
                    ]
                )
            ]
        )
    )]
    public function __invoke(
        #[MapRequestPayload] DcBarcodeDto $request,
    ): ApiResponse {
        $entity = new DcServiceBarcode();
        $this->creator->updateAndSave($entity, $request);

        return $this->responseBuilder->data(new SuccessCreateDto($entity->getId()));
    }
}
