<?php

namespace Tests\Api\User\Application;

use Anunde\Api\User\Application\UserLogger\UserLogger;
use Anunde\Api\User\Application\UserLogger\UserLoggerRequest;
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
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class UserLoggerCommandHandlerTest extends TestCase 
{
    #[Test]
    public function it_should_generate_a_jwt_token(): void
    {
        $repository = $this->createMock(IUserRepository::class);
        $passEndcoder = $this->createMock(IPasswordEncoder::class);
        $jwtEncoder = $this->createMock(IJWTEncoderService::class);

        $handler = new UserLogger($repository, $jwtEncoder, $passEndcoder);

        $id = Uuid::random();
        $name = "user";
        $surname = "user";
        $email = "user@user.com";
        $password = "password";

        $user = User::create(new UserId($id), new UserName($name), new UserSurname($surname), new UserEmail($email), new UserPassword($password)); 

        $repository->method('findUserByEmail')->with($email)->willReturn($user);
        $passEndcoder->method('isValid')->with($password, $user->getPassword()->value())->willReturn(true);
        $jwtEncoder->method('encode')->willReturn('jwt-token');

        $token = $handler->__invoke(new UserLoggerRequest($email, $password));
        $this->assertEquals('jwt-token', $token);
    }
}