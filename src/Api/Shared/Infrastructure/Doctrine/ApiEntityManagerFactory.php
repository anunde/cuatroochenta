<?php

namespace Anunde\Api\Shared\Infrastructure\Doctrine;

use Anunde\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;

final class ApiEntityManagerFactory
{
	private const SCHEMA_PATH = __DIR__ . '/../../../../../etc/databases/api.sql';

	public static function create(array $parameters, string $environment): EntityManagerInterface
	{
		$isDevMode = $environment !== 'prod';

		$prefixes = array_merge(
			DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Api', 'Anunde\Api')
		);

		$dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../Api', 'Api');
	
		return DoctrineEntityManagerFactory::create(
			$parameters,
			$prefixes,
			$isDevMode,
			self::SCHEMA_PATH,
			$dbalCustomTypesClasses
		);
	}
}