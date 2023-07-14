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

    protected $signature = 'products:import';
    protected $description = 'Import products from Fake Store Api and populate DB';

    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();

        $this->storeProducts($products);

        $this->info('Produtos importados com sucesso!');
    }

    private function storeProducts(array $products)
    {
        foreach ($products as $data) {
            $data['name'] = $data['title'];

            if ($this->productRepository->checkName($data['name'])) {
                dump($data['name'] . ' já existe');
                continue;
            }

            $this->productRepository->createProduct($data);
        }
    }
}
