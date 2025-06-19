<?php

namespace Pasha234\HwArchitecture\Infrastructure\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Pasha234\HwArchitecture\Infrastructure\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial as EntityNewsMaterial;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;
use ReflectionClass;
use Pasha234\HwArchitecture\Infrastructure\Entity\NewsMaterialMapper;

class PostgreNewsRepository extends ServiceEntityRepository implements NewsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsMaterial::class);
    }

    public function findByIds(array $ids): NewsMaterialCollection
    {
        if (empty($ids)) {
            return new NewsMaterialCollection();
        }

        $queryBuilder = $this->createQueryBuilder('nm');
        $results = $queryBuilder
            ->where($queryBuilder->expr()->in('nm.id', ':ids'))
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $results = array_map(function(NewsMaterial $newsMaterial) {
            return NewsMaterialMapper::doctrineToDomain($newsMaterial);
        }, $results);
    
        return new NewsMaterialCollection(...$results);
    }

    public function save(EntityNewsMaterial $domainNewsMaterial): void
    {
        $infrastructureNewsMaterial = NewsMaterial::fromDomain($domainNewsMaterial);

        $this->getEntityManager()->persist($infrastructureNewsMaterial);
        $this->getEntityManager()->flush();

        $reflectionClass = new ReflectionClass($domainNewsMaterial);
        $idProperty = $reflectionClass->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($domainNewsMaterial, $infrastructureNewsMaterial->id);
    }

    public function all(): NewsMaterialCollection
    {
        $results = $this->findAll();
        $results = array_map(function(NewsMaterial $newsMaterial) {
            return NewsMaterialMapper::doctrineToDomain($newsMaterial);
        }, $results);

        return new NewsMaterialCollection(...$results);
    }
}