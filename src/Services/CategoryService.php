<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Category;

class CategoryService
{
    public function __construct(
        private readonly DatabaseInterface $db,
    )
    {
    }


    public function all(): array
    {
        $categories = $this->db->get('categories');
        if (isset($categories['id'])) {
            $categories = [$categories];
        }

        return array_map(function ($category) {
            return new Category(
                id: $category['id'],
                name: $category['name'],
                createdAt: $category['created_at'],
                updatedAt: $category['updated_at']
            );
        }, $categories);
    }

}