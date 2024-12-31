<?php

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\Entity\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function persist(Entity $entity, bool $flush = false): void
    {
        $this->entityManager()->persist($entity);

        if($flush) {
            $this->entityManager()->flush($entity);
        }
    }

    public function remove(Entity $entity, bool $flush = false): void
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