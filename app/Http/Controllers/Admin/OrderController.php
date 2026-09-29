<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);

        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.product', 'user']);

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,delivery,done,canceled'],
        ]);

        DB::transaction(function () use ($order, $validated) {
            if ($validated['status'] === 'done' && $order->status !== 'done') {
                $order->load('orderItems');

                foreach ($order->orderItems as $orderItem) {
                    $product = Product::query()->lockForUpdate()->findOrFail($orderItem->product_id);

                    if ($product->has_qty && $product->stock !== null) {
                        if ($product->stock < $orderItem->quantity) {
                            throw ValidationException::withMessages(['status' => __('store.stock_unavailable')]);
                        }

                        $product->decrement('stock', $orderItem->quantity);
                    } elseif (! $product->has_qty) {
                        $product->update(['is_sold' => true]);
                    }
                }
            }

            $order->update(['status' => $validated['status']]);
        });

        return back()->with('success', __('admin.order_status_updated'));
    }
}
