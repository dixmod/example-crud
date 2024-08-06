<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceParam;

use App\Dto\Response\ResponseDto;
use App\Entity\DcServiceParam;
use App\Exception\Http\NotFoundException;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcServiceParam\Getter;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Tag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetAction
 */
class GetAction
{
    /**
     * @param Getter $getter
     * @param ApiResponseBuilder $responseBuilder
     */
    public function __construct(
        private readonly Getter $getter,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/dcServiceParam/id/{id}', name: 'GetDcServiceParam', requirements: ['id' => '\d+'], methods: ['GET'])]
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
                            ref: new Model(type: DcServiceParam::class),
                            type: 'object',
                        )
                    ]
                )
            ]
        )
    )]
    #[Tag(name: 'DcServiceParam')]
    public function __invoke(int $id): ApiResponse
    {
        /** @var DcServiceParam[] $list */
        $list = $this->getter->getByServiceId($id);
        if (count($list) === 0) {
            throw new NotFoundException();
        }
        $entity = $list[0];

        return $this->responseBuilder->data($entity);
    }
}
