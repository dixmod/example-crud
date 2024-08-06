<?php

declare(strict_types=1);

namespace App\Controller\Api\DcService;

use App\Dto\Request\DcServiceCreateDto;
use App\Dto\Response\ResponseDto;
use App\Dto\Response\SuccessCreateDto;
use App\Entity\DcService;
use App\Exception\Http\AlreadyExistException;
use App\Exception\Http\NotFoundException;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcService\Preserver;
use App\Service\DcService\RepositoryGetter;
use App\Service\DcServiceScheme\Getter as GetterScheme;
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
 */
class CreateAction
{
    private const SUCCESS_MESSAGE = 'Service successfully added';

    public function __construct(
        private readonly Preserver $preserver,
        private readonly RepositoryGetter $getter,
        private readonly GetterScheme $getterScheme,
        private readonly ApiResponseBuilder $responseBuilder,
    ) {
    }

    #[Route('/dcService/id/{id}', name: 'CreateDcService', requirements: ['id' => '\d+'], methods: ['POST'])]
    #[RequestBody(content: new Model(type: DcServiceCreateDto::class))]
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
                            ref: new Model(type: SuccessCreateDto::class),
                            type: 'object',
                        )
                    ]
                )
            ]
        )
    )]
    public function __invoke(
        int $id,
        #[MapRequestPayload] DcServiceCreateDto $request,
    ): ApiResponse {
        $isService = $this->isServiceExist($id);

        if ($isService) {
            throw new AlreadyExistException('Additional product already exist');
        }

        $entity = new DcService();
        $entity->setId($id);
        $schemeId = $request->getSchemeId();

        if ($schemeId > 0) {
            $serviceScheme = $this->getterScheme->getById($schemeId);
            if ($serviceScheme !== null) {
                $entity->setScheme($serviceScheme);
            }
        }

        $this->preserver->updateAndSave($entity, $request);

        return $this->responseBuilder->data(new SuccessCreateDto($entity->getId()), self::SUCCESS_MESSAGE);
    }

    /**
     * @param int $id
     * @return bool
     */
    private function isServiceExist(int $id): bool
    {
        try {
            $this->getter->findById($id);
            return true;
        } catch (NotFoundException) {
            return false;
        }
    }
}
