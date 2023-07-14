<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ImportProducts extends Command
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
    }

    protected $signature = 'products:import {--id= : ID of product}';
    protected $description = 'Import products from Fake Store Api and populate DB';

    public function handle()
    {
        if ($this->option('id')) {
            $this->storeOneProduct();
        }

        $this->storeProducts();
        $this->info('Produtos importados com sucesso!');
    }

    private function storeProducts()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();

        foreach ($products as $product) {
            $product['name'] = $product['title'];

            if ($this->productRepository->checkName($product['name'])) {
                $this->info($product['name'] . ' já existe');
                continue;
            }

            $this->productRepository->createProduct($product);
        }
    }

    private function storeOneProduct()
    {
        $response = Http::get('https://fakestoreapi.com/products/'. $this->option('id'));
        $product = $response->json();
        $product['name'] = $product['title'];

        if ($this->productRepository->checkName($product['name'])) {
            dd($product['name'] . ' já existe');
        }

        $this->productRepository->createProduct($product);
    }
}
