<?php

namespace Tests\Api\User\Application;

use Anunde\Api\User\Application\UserLogger\UserLoggerCommand;
use Anunde\Api\User\Application\UserLogger\UserLoggerCommandHandler;
use Anunde\Api\User\Domain\Entity\User;
use Anunde\Api\User\Domain\Entity\UserEmail;
use Anunde\Api\User\Domain\Entity\UserId;
use Anunde\Api\User\Domain\Entity\UserName;
use Anunde\Api\User\Domain\Entity\UserPassword;
use Anunde\Api\User\Domain\Entity\UserSurname;
use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\Service\IJWTEncoderService;
use Anunde\Api\User\Domain\Service\IPasswordEncoder;
use Anunde\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class UserLoggerCommandHandlerTest extends TestCase 
{
    public function testSuccessLogin(): void
    {
        $repository = $this->createMock(IUserRepository::class);
        $passEndcoder = $this->createMock(IPasswordEncoder::class);
        $jwtEncoder = $this->createMock(IJWTEncoderService::class);

        $handler = new UserLoggerCommandHandler($repository, $jwtEncoder, $passEndcoder);

        $id = Uuid::random();
        $name = "user";
        $surname = "user";
        $email = "user@user.com";
        $password = "password";

        $user = User::create(new UserId($id), new UserName($name), new UserSurname($surname), new UserEmail($email), new UserPassword($password)); 

        $repository->method('findUserByEmail')->with($email)->willReturn($user);
        $passEndcoder->method('isValid')->with($password, $user->getPassword()->value())->willReturn(true);
        $jwtEncoder->method('encode')->willReturn('jwt-token');

        $token = $handler->__invoke(new UserLoggerCommand($email, $password));
        $this->assertEquals('jwt-token', $token);
    }
}