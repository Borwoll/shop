<?php

namespace App\Http\Controllers\My;

use App\Entity\Shop\Order\Order;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\Order\CancelRequest;
use App\UseCases\Shop\OrderService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdersController extends Controller {
    private $service;

    public function __construct(OrderService $orderService) {
        $this->service = $orderService;
    }

    public function index() {
        $user = Auth::guard()->user();
        return view('my.orders.index', compact('user'));
    }

    public function show(Order $order) {
        $user = Auth::guard()->user();
        if (!$order = $this->service->findOwn($user->id, $order->id))
            throw new NotFoundHttpException('The requested page does not exist.');
        return view('my.orders.show', compact('user', 'order'));
    }

    public function cancel(CancelRequest $request, Order $order) {
        $user = Auth::guard()->user();
        $this->service->cancel($order, $user, $request);
        return redirect()->route('orders.show', $order);
    }

    public function pay(Order $order) {
        $order->pay();
        return redirect()->route('orders.show', $order);
    }
}