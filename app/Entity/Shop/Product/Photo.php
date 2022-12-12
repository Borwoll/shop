<?php

namespace App\Entity\Shop\Product;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Photo extends Model {
    use AsSource;
    public $timestamps = false;

    protected $table = 'shop_product_photos';
    protected $fillable = [
        'product_id', 'photo'
    ];
    
    public function getUrl(): string {
        return '/storage/' . $this->photo;
    }
}