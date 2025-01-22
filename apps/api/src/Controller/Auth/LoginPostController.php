<?php

namespace Anunde\Apps\Api\Controller\Auth;

use Anunde\Api\User\Application\UserLogger\UserLoggerCommand;
use Anunde\Api\User\Application\UserLogger\UserLoggerCommandHandler;
use Anunde\Shared\Infrastructure\Service\RequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginPostController extends AbstractController
{
    public function __construct(
       private UserLoggerCommandHandler $handler
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $token = $this->handler->__invoke(new UserLoggerCommand(
                RequestService::getField($request, "email"), 
                RequestService::getField($request, "password")
            ));

            return new JsonResponse(["token" => $token], Response::HTTP_OK);
        } catch (\Throwable $th) {
            dd($th); //TODO: Añadir Fixtures
            return new JsonResponse([
                'status' => false,
                'error' => $th->getMessage()
            ], $th->getCode());
        }
    }
}
