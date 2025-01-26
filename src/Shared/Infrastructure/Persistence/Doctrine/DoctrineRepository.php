<?php

namespace Anunde\Shared\Infrastructure\Persistence\Doctrine;

use Anunde\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    public function __construct(private EntityManager $entityManager)
    {
    }

    public function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    public function persist(AggregateRoot $entity, bool $flush = false): void
    {
        $this->entityManager()->persist($entity);

        if($flush) {
            $this->entityManager()->flush($entity);
        }
    }

    public function remove(AggregateRoot $entity, bool $flush = false): void
    {
        $this->entityManager()->remove($entity);
        
        if($flush) {
            $this->entityManager()->flush($entity);
        }
    }

    public function flush(): void
    {
        $this->entityManager()->flush();
    }

    public function repository(string $entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }
}