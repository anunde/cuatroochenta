<?php

namespace App\Api\Auth\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    public function __construct(
      
    ) {}

    #[Route(path: '/login', name: 'user_login', methods: "POST")]
    public function __invoke(Request $request): JsonResponse
    {
       return new JsonResponse('', Response::HTTP_OK);
    }

}