<?php

namespace Tests\Api\User\Application;

use Anunde\Api\User\Application\UserLogger\UserLogger;
use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\Service\IJWTEncoderService;
use Anunde\Api\User\Domain\Service\IPasswordEncoder;
use Anunde\Tests\Api\User\Application\UserLoggerRequestMother;
use Anunde\Tests\Api\User\Domain\UserEmailMother;
use Anunde\Tests\Api\User\Domain\UserMother;
use Anunde\Tests\Api\User\Domain\UserPasswordMother;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class UserLoggerTest extends TestCase 
{
    #[Test]
    public function it_should_generate_a_jwt_token(): void
    {
        $repository = $this->createMock(IUserRepository::class);
        $passEndcoder = $this->createMock(IPasswordEncoder::class);
        $jwtEncoder = $this->createMock(IJWTEncoderService::class);

        $email = UserEmailMother::create();
        $password = UserPasswordMother::create();

        $user = UserMother::create(
            null,
            null,
            null,
            $email,
            $password
        );

        $handler = new UserLogger($repository, $jwtEncoder, $passEndcoder);
        $request = UserLoggerRequestMother::create($email, $password);
        
        $repository->method('findUserByEmail')->with($request->getEmail())->willReturn($user);
        $passEndcoder->method('isValid')->with($request->getPassword(), $user->getPassword()->value())->willReturn(true);
        $jwtEncoder->method('encode')->willReturn('jwt-token');

        $token = $handler->__invoke($request);
        $this->assertEquals('jwt-token', $token);
    }
}