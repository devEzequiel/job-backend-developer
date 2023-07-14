<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function createProduct (array $data);
    public function getProducts(array $filters);
    public function updateProduct (array $data, int $id);
    public function deleteProduct (int $id);
    public function checkName(string $name);
}
