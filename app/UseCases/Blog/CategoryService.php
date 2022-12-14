<?php

namespace App\UseCases\Blog;

use App\Query\Blog\Category\Find\FindCategoriesTreeQuery;
use App\Query\Blog\Category\Find\FindCategoryBySlugQuery;
use App\UseCases\Service;

class CategoryService extends Service
{
    public function getAllCategories()
    {
        $categories = $this->queryBus->query(new FindCategoriesTreeQuery());
        return $categories;
    }

    public function findCategoryBySlug(string $slug)
    {
        $category = $this->queryBus->query(new FindCategoryBySlugQuery($slug));
        return $category;
    }
}