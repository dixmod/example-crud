<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceLogError;

use App\Dto\Request\DcServiceLogErrorDto;
use App\Entity\DcServiceLogError;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\Common\Preserver;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Tag;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateAction
 */
class CreateAction
{
    public function __construct(
        private readonly Preserver $creator,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route('/dcServiceLogError', name: 'CreateDcServiceLogError', methods: ['POST'])]
    #[RequestBody(content: new Model(type: DcServiceLogErrorDto::class))]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref:'#/components/schemas/ResponseOK')
    )]
    #[Tag(name: 'DcServiceLogError')]
    public function __invoke(
        #[MapRequestPayload] DcServiceLogErrorDto $request,
    ): ApiResponse {
        $entity = new DcServiceLogError();
        $this->creator->updateAndSave($entity, $request);

        return $this->responseBuilder->success();
    }
}
