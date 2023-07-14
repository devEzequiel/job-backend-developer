<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function all(FilterProductRequest $request): JsonResponse
    {
        try {
            $filters = $request->validated();
            $products = $this->productService->list($filters);

            return $this->responseOk($products);
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data = $this->productService->create($data);

            return $this->responseCreated($data, 'Produto criado com sucesso');
        } catch (Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        try {
            $product = $this->productService->update($data, $id);

            return $this->responseOk($product, 'Produto atualizado com sucesso!');
        } catch (\Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $product = $this->productService->delete($id);

            return $this->responseOk($product, 'Produto removido com sucesso!');
        } catch (\Exception $e) {
            return $this->responseUnprocessableEntity($e->getMessage());
        }
    }
}
