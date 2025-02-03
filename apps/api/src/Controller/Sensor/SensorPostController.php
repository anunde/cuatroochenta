<?php

namespace Anunde\Apps\Api\Controller\Sensor;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SensorPostController {
    public function __invoke(Request $request): Response
    {
        return new Response('', Response::HTTP_CREATED);
    }
}