<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UsersExport implements WithMultipleSheets {
    public function sheets(): array {
       return [
            new Sheets\blog_categories(),
            new Sheets\blog_posts(),
            new Sheets\blog_post_comments(),
            new Sheets\blog_post_likes(),
            new Sheets\regions(),
            new Sheets\roles(),
            new Sheets\role_users(),
            new Sheets\shop_brands(),
            new Sheets\shop_cart(),
            new Sheets\shop_categories(),
            new Sheets\shop_characteristics(),
            new Sheets\shop_characteristic_variants(),
            new Sheets\shop_delivery_methods(),
            new Sheets\shop_orders(),
            new Sheets\shop_order_customer_data(),
            new Sheets\shop_order_delivery_data(),
            new Sheets\shop_order_items(),
            new Sheets\shop_order_statuses(),
            new Sheets\shop_products(),
            new Sheets\shop_product_characteristics(),
            new Sheets\shop_product_comments(),
            new Sheets\shop_product_photos(),
            new Sheets\shop_product_reviews(),
            new Sheets\users(),
            new Sheets\users_profile(),
            new Sheets\user_comparison_items(),
            new Sheets\user_wishlist_items(),
       ];
    }
}
