<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    protected mixed $model = Product::class;

    /**
     * @throws Exception
     */
    public function getProducts(array $filters)
    {
        $products = $this->query()
//            ->filter($filters)
            ->get()/*->map(fn($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->code,
                'description' => $product->description,
                'category' => $product->category,
                'image_url' => $product->category->name ?? null
            ])*/
        ;

        if (empty($products)) {
            throw new Exception('Nenhum produto encontrado');
        }

        return $products;
    }

    public function createProduct(array $data)
    {
        return $this->create($data);
    }

    public function updateProduct(array $data, int $id)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct(int $id)
    {
        // TODO: Implement deleteProduct() method.
    }
}
