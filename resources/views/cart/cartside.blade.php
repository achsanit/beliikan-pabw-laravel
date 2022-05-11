<div class="offcanvas offcanvas-end overflow-auto" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div> 
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel"><strong>Shopping Cart</strong></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            
            @if (Cart::count() == 0)
                <div class="py-12">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-cart-plus text-gray-300" viewBox="0 0 16 16">
                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                    <div class="text-center pt-4 text-gray-400">
                        <h4>Opss.. tidak ada barang di keranjang</h4>
                    </div>
                    <div class="pt-4 flex justify-center">
                        <a href="{{ route('product.index') }}">
                            <button class="btn btn-primary">Cari Produk</button>
                        </a>
                    </div>
                </div>
            @else
                @foreach (array(Cart::content()) as $item)
                    @foreach ($item as $key => $attribute)
                        <div class="flex">
                            <div class="flex-shrink-0 w-24 h-24 border rounded-md">
                                @if (App\Models\Product::getProduct($item[$key]->id)->img_url)
                                    <img src="{{ asset('storage/' . App\Models\Product::getProduct($item[$key]->id)->img_url ) }}" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="w-full h-full object-center">
                                @else
                                    <img src="{{ asset('assets/img/fish-example.jpg') }}" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="w-full h-full object-center object-cover">
                                @endif
                            </div>
                            <div class="ml-4 flex-1 flex flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium ">
                                        <h5>{{ $item[$key]->name }}</h5>

                                        <p>Rp. {{ number_format($item[$key]->price * $item[$key]->qty) }}</p>

                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ App\Models\Product::getProduct($item[$key]->id)->category->name }}
                                    </p>
                                </div>
                                <div class="flex-1 flex justify-between text-sm">
                                    <p class="text-gray-500">
                                        Qty {{ $item[$key]->qty }} Kg
                                    </p>
                                    
                                    <div class="">
                                        <form action="{{ route('cart.destroy', $item[$key]->rowId) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <div class="pt-5">
                    <hr>
                    <div class="border-gray-200 py-3 px-4 sm:px-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Subtotal</p>
                            <p>Rp. {{ Cart::subtotal(0) }}</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                        <div class="mt-6">
                            <a href="{{ route('transaction.index') }}" class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-500 hover:bg-indigo-600 no-underline hover:no-underline">Checkout</a>
                        </div>
                        <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                            <p>
                                or 
                                <a href="{{ route('cart.index') }}" class="on-underline">
                                    <button type="button" class="text-indigo-600 font-medium hover:text-indigo-500">View Cart<span aria-hidden="true"> &rarr;</span></button>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div> 
    </div>
</div>
