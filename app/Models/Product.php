<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image_url'
    ];

    public function scopeFilter($query, $filters)
    {
        $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('category', 'LIKE', '%' . $search . '%');
            })
            ->when(isset($filters['with_image']) && $filters['with_image'] === true, function ($query) {
                $query->whereNotNull('image_url');
            })
            ->when(isset($filters['with_image']) && $filters['with_image'] === false, function ($query) {
                $query->whereNull('image_url');
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['product_id'] ?? null, function ($query, $id) {
                $query->where('id', $id);
            });
    }

    public $timestamps = false;
}
