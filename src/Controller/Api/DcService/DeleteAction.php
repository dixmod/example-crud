<?php

declare(strict_types=1);

namespace App\Controller\Api\DcService;

use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\DcService\Remover;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteAction
 */
class DeleteAction extends AbstractController
{
    public function __construct(
        private readonly Remover $remover,
        private readonly ApiResponseBuilder $responseBuilder
    ) {
    }

    #[Route('/dcService/id/{id}', name: 'DeleteDcService', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref:'#/components/schemas/ResponseOK')
    )]
    #[Tag(name: 'DcService')]
    public function __invoke(int $id): ApiResponse
    {
        $this->remover->remove($id);

        return $this->responseBuilder->success();
    }
}
