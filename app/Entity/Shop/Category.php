<?php

namespace App\Entity\Shop;

use App\Entity\Shop\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Orchid\Screen\AsSource;

class Category extends Model {
    use AsSource;
    use NodeTrait;

    public $timestamps = false;

    protected $table = 'shop_categories';
    protected $fillable = [
        'parent_id', 'name', 'slug', 'title', 'description'
    ];

    public static function new(
        $parent, $name,
        $slug, $title,
        $description
    ): self
    {
        return static::create([
            'parent_id' => $parent,
            'name' => $name,
            'slug' => $slug,
            'title' => $title,
            'description' => $description
        ]);
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getSeoTitle(): string {
        return $this->title ?? $this->name;
    }
}