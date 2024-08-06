<?php

declare(strict_types=1);

namespace App\Controller\Api\DcServiceLogHistory;

use App\Dto\Request\DcServiceLogHistoryDto;
use App\Entity\DcService;
use App\Entity\DcServiceLogHistory;
use App\Response\ApiResponse;
use App\Response\ApiResponseBuilder;
use App\Service\Common\Preserver;
use Doctrine\ORM\EntityManagerInterface;
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
        private readonly ApiResponseBuilder $responseBuilder,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('/dcServiceLogHistory', name: 'CreateDcServiceLogHistory', methods: ['POST'])]
    #[RequestBody(content: new Model(type: DcServiceLogHistoryDto::class))]
    #[Response(
        response: 200,
        description: 'OK',
        content: new JsonContent(ref:'#/components/schemas/ResponseOK')
    )]
    #[Tag(name: 'DcServiceLogHistory')]
    public function __invoke(
        #[MapRequestPayload] DcServiceLogHistoryDto $request,
    ): ApiResponse {
        $entity = new DcServiceLogHistory();

        if (null !== $request->getServiceId()) {
            $service = $this->em->getRepository(DcService::class)->find($request->getServiceId());
            $entity->setService($service);
        }

        $this->creator->updateAndSave($entity, $request);

        return $this->responseBuilder->success();
    }
}
