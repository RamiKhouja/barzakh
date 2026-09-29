<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private const DELIVERY_FEE = 8;
    private const FREE_DELIVERY_FROM = 300;

    public function checkout()
    {
        return view('client.orders.checkout', [
            'states' => $this->states(),
            'user' => request()->user(),
        ]);
    }

    public function store(Request $request)
    {
        if (is_string($request->input('items'))) {
            $request->merge(['items' => json_decode($request->input('items'), true) ?: []]);
        }

        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:1000'],
            'message' => ['nullable', 'string'],
            'language' => ['required', 'in:en,ar,fr'],
            'payment_method' => ['required', 'in:cash'],
        ]);

        $order = DB::transaction(function () use ($validated, $request) {
            $subtotal = 0;
            $items = [];

            foreach ($validated['items'] as $cartItem) {
                $product = Product::query()->lockForUpdate()->findOrFail($cartItem['product_id']);
                $quantity = $product->has_qty ? $cartItem['quantity'] : 1;

                if ($product->is_sold) {
                    abort(422, __('store.product_sold'));
                }

                if ($product->has_qty && $product->stock !== null && $quantity > $product->stock) {
                    abort(422, __('store.stock_unavailable'));
                }

                $unitPrice = $product->is_discount && $product->discount_price !== null
                    ? $product->discount_price
                    : $product->price;

                $subtotal += $unitPrice * $quantity;
                $items[] = compact('product', 'quantity', 'unitPrice');
            }

            $delivery = $subtotal >= self::FREE_DELIVERY_FROM ? 0 : self::DELIVERY_FEE;
            $client = collect($validated)->only([
                'firstname', 'lastname', 'email', 'phone', 'country', 'state',
                'city', 'zip_code', 'address',
            ])->toArray();

            $order = Order::create([
                'public_token' => Str::random(48),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'delivery' => $delivery,
                'total' => $subtotal + $delivery,
                'user_id' => $request->user()?->id,
                'client' => $client,
                'message' => $validated['message'] ?? '',
                'language' => $validated['language'],
                'payment_method' => 'cash',
            ]);

            foreach ($items as $item) {
                $order->orderItems()->create([
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                ]);

            }

            return $order;
        });

        return redirect()->route('orders.show', $order->public_token)
            ->with('order_created', true);
    }

    public function show(string $token)
    {
        $order = Order::with('orderItems.product')->where('public_token', $token)->firstOrFail();

        return view('client.orders.show', compact('order'));
    }

    public function saveGuestInfo(Request $request, string $token)
    {
        $order = Order::where('public_token', $token)->whereNull('user_id')->firstOrFail();

        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (\App\Models\User::where('email', $order->client['email'] ?? null)->exists()) {
            return back()->withErrors(['password' => __('store.email_already_registered')]);
        }

        $client = $order->client;
        $user = \App\Models\User::create([
            'firstname' => $client['firstname'],
            'lastname' => $client['lastname'] ?? null,
            'email' => $client['email'],
            'phone' => $client['phone'],
            'country' => $client['country'],
            'city' => $client['city'],
            'zip_code' => $client['zip_code'] ?? null,
            'address' => $client['address'],
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);
        $order->update(['user_id' => $user->id]);

        return redirect()->route('orders.show', $order->public_token);
    }

    private function states(): array
    {
        return [
            ['en' => 'Tunis', 'ar' => 'تونس'], ['en' => 'Ariana', 'ar' => 'أريانة'],
            ['en' => 'Ben Arous', 'ar' => 'بن عروس'], ['en' => 'Manouba', 'ar' => 'منوبة'],
            ['en' => 'Nabeul', 'ar' => 'نابل'], ['en' => 'Zaghouan', 'ar' => 'زغوان'],
            ['en' => 'Bizerte', 'ar' => 'بنزرت'], ['en' => 'Béja', 'ar' => 'باجة'],
            ['en' => 'Jendouba', 'ar' => 'جندوبة'], ['en' => 'Kef', 'ar' => 'الكاف'],
            ['en' => 'Siliana', 'ar' => 'سليانة'], ['en' => 'Kairouan', 'ar' => 'القيروان'],
            ['en' => 'Kasserine', 'ar' => 'القصرين'], ['en' => 'Sidi Bouzid', 'ar' => 'سيدي بوزيد'],
            ['en' => 'Sousse', 'ar' => 'سوسة'], ['en' => 'Monastir', 'ar' => 'المنستير'],
            ['en' => 'Mahdia', 'ar' => 'المهدية'], ['en' => 'Sfax', 'ar' => 'صفاقس'],
            ['en' => 'Gafsa', 'ar' => 'قفصة'], ['en' => 'Tozeur', 'ar' => 'توزر'],
            ['en' => 'Kebili', 'ar' => 'قبلي'], ['en' => 'Gabès', 'ar' => 'قابس'],
            ['en' => 'Medenine', 'ar' => 'مدنين'], ['en' => 'Tataouine', 'ar' => 'تطاوين'],
        ];
    }
}
