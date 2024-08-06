<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceParam;

use App\Dto\Request\DcServiceParamDto;
use App\Entity\DcServiceParam;
use App\Exception\Http\AlreadyExistException;
use App\Service\DcServiceParam\Getter as ParamsGetter;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\Common\Preserver;
use App\Service\DcService\Getter;
use Exception;
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
        private readonly Preserver $updater,
        private readonly ParamsGetter $getter,
        private readonly ApiResponseBuilder $responseBuilder,
        private readonly Getter $serviceGetter
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('/dcServiceParam', name: 'CreateDcServiceParam', methods: ['POST'])]
    #[RequestBody(content: new Model(type: DcServiceParamDto::class))]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref: '#/components/schemas/ResponseOK')
    )] #[Tag(name: 'DcServiceParam')]
    public function __invoke(
        #[MapRequestPayload] DcServiceParamDto $request,
    ): ApiResponse {
        $isService = $this->isServiceParamsExist($request->getServiceId());

        if ($isService) {
            throw new AlreadyExistException('Additional product params already exist');
        }

        $entity = new DcServiceParam();
        $service = $this->serviceGetter->findById($request->getServiceId());
        $entity->setService($service);
        $this->updater->updateAndSave($entity, $request);

        return $this->responseBuilder->success();
    }

    /**
     * @param int $id
     * @return bool
     */
    private function isServiceParamsExist(int $id): bool
    {
        $list = $this->getter->getByServiceId($id);
        if (count($list) === 0) {
            return false;
        }

        return true;
    }
}
