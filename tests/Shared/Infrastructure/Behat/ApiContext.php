<?php

declare(strict_types=1);

namespace Anunde\Tests\Shared\Infrastructure\Behat;

use Anunde\Api\User\Domain\Repository\IUserRepository;
use Anunde\Api\User\Domain\Service\IPasswordEncoder;
use Anunde\Tests\Api\User\Domain\UserEmailMother;
use Anunde\Tests\Api\User\Domain\UserMother;
use Anunde\Tests\Api\User\Domain\UserPasswordMother;
use Anunde\Tests\Shared\Infrastructure\Mink\MinkHelper;
use Anunde\Tests\Shared\Infrastructure\Mink\MinkSessionRequestHelper;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

final class ApiContext extends RawMinkContext
{
	private readonly MinkHelper $sessionHelper;
	private readonly MinkSessionRequestHelper $request;
	private readonly IUserRepository $repository;
	private readonly IPasswordEncoder $passwordEncoder;
	private readonly EntityManagerInterface $entityManager;

	public function __construct(private readonly Session $minkSession, IUserRepository $repository, IPasswordEncoder $passwordEncoder, EntityManagerInterface $entityManager)
	{
		$this->sessionHelper = new MinkHelper($this->minkSession);
		$this->request = new MinkSessionRequestHelper(new MinkHelper($minkSession));
		$this->repository = $repository;
		$this->passwordEncoder = $passwordEncoder;
		$this->entityManager = $entityManager;
	}

	/**
	 * @Given I send a :method request to :url
	 */
	public function iSendARequestTo(string $method, string $url): void
	{
		$this->request->sendRequest($method, $this->locatePath($url));
	}

	/**
	 * @Given I send a :method request to :url with body:
	 */
	public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
	{
		$this->request->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
	}

	/**
	 * @Given there is a user:
	 */
	public function thereIsAUser(TableNode $table): void
    {
		$data = $table->getHash()[0];
		$user = UserMother::create(
			null,
			null,
			null,
			UserEmailMother::create($data['email']),
			UserPasswordMother::create($this->passwordEncoder->encode($data['password'])),
		);

        $this->repository->save($user);
    }

	/**
	 * @Then the response content should be:
	 */
	public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
	{
		$expected = $this->sanitizeOutput($expectedResponse->getRaw());
		$actual = $this->sanitizeOutput($this->sessionHelper->getResponse());

		if ($expected === false || $actual === false) {
			throw new RuntimeException('The outputs could not be parsed as JSON');
		}

		if ($expected !== $actual) {
			throw new RuntimeException(
				sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
			);
		}
	}

	/**
	 * @Then the response should be empty
	 */
	public function theResponseShouldBeEmpty(): void
	{
		$actual = trim($this->sessionHelper->getResponse());

		if (!empty($actual)) {
			throw new RuntimeException(sprintf("The outputs is not empty, Actual:\n%s", $actual));
		}
	}

	/**
	 * @Then print last api response
	 */
	public function printApiResponse(): void
	{
		print_r($this->sessionHelper->getResponse());
	}

	/**
	 * @Then print response headers
	 */
	public function printResponseHeaders(): void
	{
		print_r($this->sessionHelper->getResponseHeaders());
	}

	/**
	 * @Then the response status code should be :expectedResponseCode
	 */
	public function theResponseStatusCodeShouldBe(mixed $expectedResponseCode): void
	{
		if ($this->minkSession->getStatusCode() !== (int) $expectedResponseCode) {
			throw new RuntimeException(
				sprintf(
					'The status code <%s> does not match the expected <%s>',
					$this->minkSession->getStatusCode(),
					$expectedResponseCode
				)
			);
		}
	}

	private function sanitizeOutput(string $output): false | string
	{
		return json_encode(json_decode(trim($output), true, 512, JSON_THROW_ON_ERROR), JSON_THROW_ON_ERROR);
	}

	/** @BeforeScenario */
    public function beginTransaction(BeforeScenarioScope $scope)
    {
        $this->entityManager->getConnection()->beginTransaction();
    }

    /** @AfterScenario */
    public function rollbackTransaction(AfterScenarioScope $scope)
    {
        $this->entityManager->getConnection()->rollBack();
    }
}