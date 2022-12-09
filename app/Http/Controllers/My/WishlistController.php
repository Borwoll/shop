<?php

namespace App\Http\Controllers\My;

use App\Entity\User\User;
use App\Entity\User\WishlistItem;
use App\Http\Controllers\Controller;
use App\UseCases\My\WishlistService;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private $service;

    public function __construct(WishlistService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        /** @var User $user */
        $user = Auth::guard()->user();
        $query = $this->service->getAllWishlistItems($user);

        $items = $query->paginate(10);

        return view('my.wishlist.index', compact('items', 'user'));
    }

    public function create()
    {
        if (request()->ajax()) {
            /** @var User $user */
            $user = Auth::guard()->user();
            $productId = request()->post('productId');

            $this->service->create($user, $productId);
        }
    }

    public function remove(WishlistItem $item)
    {
        $this->service->remove($item);

        return redirect()
            ->route('my.wishlist.index')
            ->with('success', 'Item successfully deleted');
    }
}