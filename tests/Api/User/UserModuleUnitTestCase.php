<?php

namespace Anunde\Tests\Api\User;

use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\Service\IJWTEncoderService;
use Anunde\Api\User\Domain\Service\IPasswordEncoder;
use Anunde\Api\User\Domain\User;
use Anunde\Api\User\Domain\UserEmail;
use Anunde\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class UserModuleUnitTestCase extends UnitTestCase
{
    private IUserRepository | MockInterface | null $repository;
    private IPasswordEncoder | MockInterface | null $passwordEncoder;
    private IJWTEncoderService | MockInterface | null $jwtEncoder;

    protected function shouldSearch(string $email, ?User $user): void
    {
        $this->repository()
            ->shouldReceive('findUserByEmail')
            ->with($this->similarTo($email))
            ->once()
            ->andReturn($user);
    }

    protected function shouldBeValidPassword(string $password, string $hash): void
    {
        $this->passwordEncoder()
            ->shouldReceive('isValid')
            ->with($this->similarTo($password), $this->similarTo($hash))
            ->once()
            ->andReturn(true);
    }

    protected function shouldBeInvalidPassword(string $password, string $hash): void
    {
        $this->passwordEncoder()
            ->shouldReceive('isValid')
            ->with($this->similarTo($password), $this->similarTo($hash))
            ->once()
            ->andReturn(false);
    }

    protected function shouldCreateJwtToken(): void
    {
        $this->jwtEncoder()
            ->shouldReceive('encode')
            ->once()
            ->andReturn('jwt-token');
    }

    protected function repository(): IUserRepository | MockInterface
    {
        return $this->repository ??= $this->mock(IUserRepository::class);
    }

    protected function passwordEncoder(): IPasswordEncoder | MockInterface
    {
        return $this->passwordEncoder ??= $this->mock(IPasswordEncoder::class);
    }

    protected function jwtEncoder(): IJWTEncoderService | MockInterface
    {
        return $this->jwtEncoder ??= $this->mock(IJWTEncoderService::class);
    }
}