<?php

namespace App\Services\Product;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * @param array $filters
     * @return array
     * @throws Exception
     */
    public function list(array $filters)
    {
        return $this->productRepository->getProducts($filters);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->deleteProduct($id);
    }

    public function update(array $data, int $id)
    {
        return $this->productRepository->updateProduct($data, $id);
    }
}
