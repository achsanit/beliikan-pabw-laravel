<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<link rel="stylesheet" href="{{ asset('css/productStyle/productStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/productStyle/themify-icons.css') }}">

<x-app-layout>
    <x-slot name="slot">
        @if (session('addToCart'))
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#button-modal').click();
                    $('#success-modal').modal();
                });
            </script>
            <button type="button" hidden="hidden" class="btn btn-primary" id="button-modal" data-bs-toggle="modal" data-bs-target="#success-modal">
                Launch demo modal
            </button>
            <!-- Modal -->
            <div class="modal fade pt-0 mt-0" id="success-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add To Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="flex justify-center pt-3 pb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-cart-check text-success" viewBox="0 0 16 16">
                                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check2-all text-success" viewBox="0 0 16 16">
                                    <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                </svg> -->
                            </div>
                            <div class="text-center">
                                <h5>berhasil memasukkan produk <br>ke keranjang</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="bg-gray-100">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pt-24 text-center">
                    <h1><strong>Product</strong></h1>
                </div>
                <div>
                    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                        <ol class="breadcrumb bg-gray-100">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
                <!-- Search -->
                <div class="search">
                    <form action="{{ route('product.index') }}" method="get">
                        <div class="input-group mt-8 mx-auto max-w-2xl">
                            <input type="text" class="form-control " placeholder="Search Your Products..." name="search" value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- product -->
                @if ($products->count() > 0)
                    <div class="tab-pane fade show active pb-12" id="ikan" role="tabpanel">
                        <div class="tab-single">
                            <div class="row flex justify-center">
                                @foreach ($products as $product)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-10">
                                        <div class="single-product">
                                            <div class="product-img border">
                                                <div class="img"></div>
                                                <a href="{{ route('product.show',[$product->id]) }}">
                                                    @if ($product->img_url)
                                                        <div style="width: 100%; height: 150px; overflow:hidden;">
                                                            <img class="img-fluid rounded-b-xl p-3"  src="{{ asset('storage/' . $product->img_url) }}" alt="">
                                                        </div>
                                                    @else
                                                        <div style="width: 100%; height: 150px; overflow:hidden;">
                                                            <img class="img-fluid rounded-b-xl" src="{{ asset('assets/img/fish-example.jpg') }}" alt="">
                                                        </div>
                                                        
                                                    @endif

                                                    @foreach ($latestProducts as $latest)
                                                        @if ($product->id == $latest->id)
                                                            <span class="new">New</span>
                                                        @endif
                                                    @endforeach
                                                </a>
                                                <div class="button-head">
                                                    <!-- <div class="product-action py-n3">
                                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#" class="no-underline mt-20px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                            <span>Details</span>
                                                        </a>
                                                        <a title="Wishlist" href="" class="no-underline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                            </svg>
                                                            <span>Add to Wishlist</span></a>
                                                    </div> -->
                                                    <form action="{{ route('cart.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <div class="product-action-2 text-center pr-3 py-1">
                                                            <button type="submit" class="">
                                                                <a title="Add to cart" class="no-underline">Add to cart</a>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="product-content mx-3 mb-5 mt-3 ">
                                                    <h5>{{ $product->name }}</h5>
                                                    <div class="product-price">
                                                        <span>Rp. {{ number_format($product->price) }} /Kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-search text-secondary" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </div>
                    <div class="text-center text-secondary pb-32">
                        <h4>Oppss Produk yang kamu cari tidak ada....</h4>
                    </div>
                @endif
                <div class="pb-24">
                    {{ $products->links() }}
                </div>
            </div>
            
        </div>
        
    </x-slot>
</x-app-layout>
