<?php

namespace App\Api\Auth\Application\UserLogger;

use App\Api\Auth\Domain\Exception\UserUnauthorizedException;
use App\Api\Auth\Domain\Repository\IUserRepository;
use App\Api\Auth\Domain\Service\IJWTEncoderService;
use App\Api\Auth\Domain\Service\IPasswordEncoder;
use App\Shared\Domain\Exception\NotFoundException;

final class UserLoggerCommandHandler
{
    public function __construct(
      private IUserRepository $repository,
      private IJWTEncoderService $jwtEncoder,
      private IPasswordEncoder $passwordEnconder
    ) {}

    public function __invoke(UserLoggerCommand $command): string
    {
      if(null === $user = $this->repository->findUserByEmail($command->getEmail())) {
        throw new NotFoundException('User not found');
      }

      if(!$this->passwordEnconder->isValid($command->getPassword(), $user->getPassword()->value())) {
        throw new UserUnauthorizedException('Invalid credentials');
      }

      return $this->jwtEncoder->encode(['email' => $user->getEmail()->value(), "exp" => time() + 3600]);
    }
}