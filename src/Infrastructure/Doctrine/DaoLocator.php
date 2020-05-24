<?php

declare(strict_types = 1);

namespace GOG\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use GOG\Application\DaoLocator as Port;

final class DaoLocator implements Port
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(string $name)
    {
        return $this->entityManager->getRepository($name);
    }
}
