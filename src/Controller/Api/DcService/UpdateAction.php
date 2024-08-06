<?php

declare(strict_types=1);

namespace App\Controller\Api\DcService;

use App\Dto\Request\DcServiceUpdateDto;
use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcService\Preserver;
use App\Service\DcService\RepositoryGetter;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Tag;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateAction
 */
class UpdateAction
{
    public function __construct(
        private readonly RepositoryGetter $getter,
        private readonly Preserver $preserver,
        private readonly ApiResponseBuilder $responseBuilder,
    ) {
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/dcService/id/{id}', name: 'UpdateDcService', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[RequestBody(content: new Model(type: DcServiceUpdateDto::class))]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref: '#/components/schemas/ResponseOK')
    )]
    #[Tag(name: 'DcService')]
    public function __invoke(
        int $id,
        #[MapRequestPayload] DcServiceUpdateDto $request,
    ): ApiResponse {
        /** @var DcService $entity */
        $entity = $this->getter->getById($id);

        $this->preserver->updateAndSave($entity, $request);

        return $this->responseBuilder->success();
    }
}
