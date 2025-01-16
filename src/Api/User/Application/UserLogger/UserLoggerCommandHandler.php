<?php

namespace Anunde\Api\User\Application\UserLogger;

use Anunde\Api\User\Domain\Exception\UserUnauthorizedException;
use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\Service\IJWTEncoderService;
use Anunde\Api\User\Domain\Service\IPasswordEncoder;
use Anunde\Shared\Domain\Exception\NotFoundException;

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