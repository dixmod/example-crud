<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceParam;

use App\Dto\Request\DcServiceParamDto;
use App\Exception\Http\NotFoundException;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\Common\Preserver;
use App\Service\DcService\Getter as ServiceGetter;
use App\Service\DcServiceParam\Getter;
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
        private readonly Getter $getter,
        private readonly ServiceGetter $serviceGetter,
        private readonly Preserver $preserver,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/dcServiceParam/id/{id}', name: 'UpdateDcServiceParam', requirements: ['id' => '\d+'], methods: ['PUT'])]
    #[RequestBody(content: new Model(type: DcServiceParamDto::class))]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref:'#/components/schemas/ResponseOK')
    )]
    #[Tag(name: 'DcServiceParam')]
    public function __invoke(
        int $id,
        #[MapRequestPayload] DcServiceParamDto $request,
    ): ApiResponse {
        $list = $this->getter->getByServiceId($id);
        if (count($list) === 0) {
            throw new NotFoundException();
        }

        $entity = $list[0];
        $service = $this->serviceGetter->findById($request->getServiceId());
        $entity->setService($service);
        $this->preserver->updateAndSave($entity, $request);

        return $this->responseBuilder->success();
    }
}
