<div id="product-cart-controls" class="mt-8 flex flex-wrap items-center gap-3">
    @if($product->has_qty)
        <div class="flex items-center rounded-full bg-white shadow-sm dark:bg-gray-400">
            <button id="product-minus" type="button" class="px-4 py-3 text-xl disabled:opacity-40" @disabled($product->is_sold || ($product->stock !== null && $product->stock < 1))>−</button>
            <span id="product-quantity" class="min-w-8 text-center">1</span>
            <button id="product-plus" type="button" class="px-4 py-3 text-xl disabled:opacity-40" @disabled($product->is_sold || ($product->stock !== null && $product->stock < 1))>+</button>
        </div>
    @endif
    <button id="add-product-to-cart" type="button" @disabled($product->is_sold || ($product->has_qty && $product->stock !== null && $product->stock < 1)) class="rounded-full bg-bordo px-8 py-3 font-semibold text-white shadow-sm hover:bg-primary-700 disabled:cursor-not-allowed disabled:opacity-50">
        <x-heroicon-s-shopping-cart class="inline h-5 w-5" /> <span>{{ __('store.add_to_cart') }}</span>
    </button>
</div>
<script>
    (() => {
        const product = @js([
            'id' => $product->id,
            'name' => $lang === 'ar' ? $product->name_ar : $product->name_en,
            'name_en' => $product->name_en,
            'name_ar' => $product->name_ar,
            'price' => (float) ($hasDiscount ? $product->discount_price : $product->price),
            'image' => $product->main_image ? asset('pictures'.$product->main_image) : asset('pictures/global/og-main.jpeg'),
            'has_qty' => (bool) $product->has_qty,
            'stock' => $product->stock === null ? null : (int) $product->stock,
            'is_sold' => (bool) $product->is_sold,
        ]);
        let quantity = 1;
        const quantityNode = document.getElementById('product-quantity');
        const minus = document.getElementById('product-minus');
        const plus = document.getElementById('product-plus');
        const refresh = () => { if (!quantityNode) return; quantityNode.textContent = quantity; minus.disabled = quantity <= 1; plus.disabled = product.stock !== null && quantity >= product.stock; };
        document.getElementById('add-product-to-cart').addEventListener('click', () => window.barzakhCart.add(product, quantity));
        minus?.addEventListener('click', () => { quantity--; refresh(); });
        plus?.addEventListener('click', () => { quantity++; refresh(); });
        refresh();
    })();
</script>
