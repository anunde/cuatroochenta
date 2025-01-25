<?php

namespace Anunde\Apps\Api\Controller\Auth;

use Anunde\Api\User\Application\UserLogger\UserLogger;
use Anunde\Api\User\Application\UserLogger\UserLoggerRequest;
use Anunde\Shared\Infrastructure\Service\RequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginPostController extends AbstractController
{
    public function __construct(
       private UserLogger $handler
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $token = $this->handler->__invoke(new UserLoggerRequest(
                RequestService::getField($request, "email"), 
                RequestService::getField($request, "password")
            ));

            return new JsonResponse(["token" => $token], Response::HTTP_OK);
        } catch (\Throwable $th) {
             //TODO: Añadir Fixtures
            return new JsonResponse([
                'status' => false,
                'error' => $th->getMessage()
            ], $th->getCode());
        }
    }
}
