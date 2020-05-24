<?php

declare(strict_types = 1);

namespace GOG\Infrastructure\Doctrine\Dao;

use ArrayObject;
use Doctrine\ORM\EntityRepository;
use GOG\Application\Dao\ProductDao as Port;
use GOG\Application\Data\Product;
use GOG\Application\Exception\Dao\CouldNotCreateReference;
use GOG\Application\Exception\Unchecked;
use GOG\Application\Value\Limit;
use GOG\Application\Value\Page;
use Throwable;

final class ProductDao extends EntityRepository implements Port
{
    public function getById(int $id): Product
    {
        try {
            return $this
                ->createQueryBuilder('product')
                ->where('product.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (Throwable $exception) {
            throw Unchecked::wrap($exception);
        }
    }

    public function getPage(Page $page): ArrayObject
    {
        $data = $this
            ->createQueryBuilder('product')
            ->setFirstResult($page->offset(new Limit(self::LIMIT))->value())
            ->setMaxResults(self::LIMIT)
            ->getQuery()
            ->getResult();

        $catalog = new ArrayObject();
        foreach ($data as $datum) {
            $catalog->append($datum);
        }

        return $catalog;
    }

    public function save(Product ...$products): void
    {
        try {
            foreach ($products as $product) {
                $this->getEntityManager()->persist($product);
            }

            $this->getEntityManager()->flush($products);
        } catch (Throwable $exception) {
            throw Unchecked::wrap($exception);
        }
    }

    public function remove(int ...$productIds): void
    {
        try {
            $products = [];
            foreach ($productIds as $productId) {
                $product = $this->getReference($productId);
                $this->getEntityManager()->remove($product);
                $products[] = $product;
            }

            $this->getEntityManager()->flush($products);
        } catch (Throwable $exception) {
            throw Unchecked::wrap($exception);
        }
    }

    private function getReference(int $productId): Product
    {
        $reference = $this->getEntityManager()->getReference($this->getEntityName(), $productId);

        if ($reference instanceof Product) {
            return $reference;
        }

        throw CouldNotCreateReference::self($this->getEntityName(), $productId);
    }
}
