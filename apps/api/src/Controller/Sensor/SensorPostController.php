<?php

namespace Anunde\Apps\Api\Controller\Sensor;

use Anunde\Api\Sensor\Application\SensorRegister\SensorRegister;
use Anunde\Api\Sensor\Application\SensorRegister\SensorRegisterRequest;
use Anunde\Shared\Infrastructure\Service\RequestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SensorPostController {

    public function __construct(
        private SensorRegister $handler
    )
    {}

    public function __invoke(Request $request): Response
    {
        dd('aqui llega');
        $this->handler->__invoke(
            new SensorRegisterRequest(
                RequestService::getField($request, "id"),
                RequestService::getField($request, "name")
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }
}