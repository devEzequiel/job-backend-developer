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

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getBook(int $id): array
    {
        $product = $this->product::query()
            ->where('id', $id)
            ->with('category', 'type')
            ->get()->map(fn($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->code,
                'size' => $product->size . ' pages',
                'created_at' => $product->created_at,
                'category' => $product->category->name ?? null,
                'type' => $product->type->description
            ])->toArray();

        if (!$product) {
            throw new Exception('Livro não encontrado');
        }

        return $product;
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->deleteProduct($id);
    }

    public function update(array $data, int $id): bool
    {
        return $this->productRepository->updateProduct($data, $id);
    }
}
