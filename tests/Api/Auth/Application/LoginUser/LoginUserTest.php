<?php

namespace Tests\Api\Auth\Application\LoginUser;

use App\Api\Auth\Application\UserLogger\UserLoggerCommand;
use App\Api\Auth\Application\UserLogger\UserLoggerCommandHandler;
use App\Api\Auth\Domain\Entity\User;
use App\Api\Auth\Domain\Repository\IUserRepository;
use App\Api\Auth\Domain\Service\IJWTEncoderService;
use App\Api\Auth\Domain\Service\IPasswordEncoder;
use PHPUnit\Framework\TestCase;

final class LoginUserTest extends TestCase
{
    public function testLoginUser(): void
    {
        $repository = $this->createMock(IUserRepository::class);
        $passwordEncoder = $this->createMock(IPasswordEncoder::class);
        $jwtEncoder = $this->createMock(IJWTEncoderService::class);
        $handler = new UserLoggerCommandHandler($repository, $jwtEncoder, $passwordEncoder);

        $email = "user@user.com";
        $password = "12345678";

        $user = new User($email, $password);

        $repository->expects($this->once())
            ->method('findUserByEmail')
            ->with($email)
            ->willReturn($user);

        $passwordEncoder->expects($this->once())
            ->method('isValid')
            ->with($password, $user->getPassword())
            ->willReturn(true);

        $jwtEncoder->expects($this->once())
            ->method('encode')
            ->willReturn('valid-jwt-token');

        $handler->__invoke(new UserLoggerCommand($email, $password));
    }
}