<?php

namespace Anunde\Apps\Api\Controller\HealthCheck;

use Symfony\Component\HttpFoundation\JsonResponse;

final class HealthCheckGetController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => 'OK'
            ]
        );
    }
}