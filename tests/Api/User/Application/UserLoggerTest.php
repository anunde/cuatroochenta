<?php

namespace Anunde\Tests\Api\User\Application;

use Anunde\Api\User\Application\UserLogger\UserLogger;
use Anunde\Api\User\Domain\Exception\UserUnauthorizedException;
use Anunde\Shared\Domain\Exception\NotFoundException;
use Anunde\Tests\Api\User\Application\UserLoggerRequestMother;
use Anunde\Tests\Api\User\Domain\UserEmailMother;
use Anunde\Tests\Api\User\Domain\UserMother;
use Anunde\Tests\Api\User\Domain\UserPasswordMother;
use Anunde\Tests\Api\User\UserModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

final class UserLoggerTest extends UserModuleUnitTestCase 
{
    private UserLogger | null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new UserLogger($this->repository(), $this->jwtEncoder(), $this->passwordEncoder());
	}

    #[Test]
    public function it_should_generate_a_jwt_token(): void
    {
        $email = UserEmailMother::create();
        $password = UserPasswordMother::create();

        $user = UserMother::create(
            null,
            null,
            null,
            $email,
            $password
        );

        $request = UserLoggerRequestMother::create($email, $password);
        
        $this->shouldSearch($email->value(), $user);
        $this->shouldBeValidPassword($request->getPassword(), $user->getPassword()->value());
        $this->shouldCreateJwtToken();

        $token = $this->handler->__invoke($request);
        $this->assertEquals('jwt-token', $token);
    }

    #[Test]
    public function it_should_throw_an_exception_when_user_not_exist(): void
    {
        $this->expectException(NotFoundException::class);

        $email = UserEmailMother::create();
        $password = UserPasswordMother::create();
        $request = UserLoggerRequestMother::create($email, $password);
        
        $this->shouldSearch($email->value(), null);

        $this->handler->__invoke($request);
    }

    #[Test]
    public function it_should_throw_an_exception_when_user_not_authorized(): void
    {
        $this->expectException(UserUnauthorizedException::class);

        $email = UserEmailMother::create();
        $user = UserMother::create(
            null,
            null,
            null,
            $email,
            null
        );
        $request = UserLoggerRequestMother::create($email);
        
        $this->shouldSearch($email->value(), $user);
        $this->shouldBeInvalidPassword($request->getPassword(), $user->getPassword()->value());

        $this->handler->__invoke($request);
    }
}