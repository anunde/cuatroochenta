<?php

namespace App\Api\Auth\Infrastructure\Controller;

use App\Api\Auth\Application\UserLogger\UserLoggerCommand;
use App\Api\Auth\Application\UserLogger\UserLoggerCommandHandler;
use App\Shared\Infrastructure\Service\RequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    public function __construct(
       private UserLoggerCommandHandler $handler
    ) {}

    #[Route(path: '/login', name: 'user_login', methods: "POST")]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $token = $this->handler->__invoke(new UserLoggerCommand(
                RequestService::getField($request, "email"), 
                RequestService::getField($request, "password")
            ));

            return new JsonResponse($token, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return new JsonResponse([
                'status' => false,
                'error' => $th->getMessage()
            ], $th->getCode());
        }
    }
}
