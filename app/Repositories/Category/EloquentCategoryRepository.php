<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Traits\CRUDOperations;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{

    use CRUDOperations;

    public string $model = Category::class;
}
