<link rel="stylesheet" href="{{ asset('css/productStyle/productStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/productStyle/themify-icons.css') }}">
<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
            <div class="mt-24 text-center">
                <h1><strong>Detail Produk</strong></h1>
            </div>
            <div>
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="mt-3 mb-12 flex justify-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('product.index') }}" class="no-underline text-blue-400  hover:no-underline">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>

            <!--Section: Block Content-->
            <section class="">
                <div class="container">
                    <div class="row pt-8">
                        <div class="col-md-6 mb-4 mb-md-0 flex justify-end">
                            <div class="mdb-lightbox">
                                <div class="row product-gallery mx-1">
                                    <div class="col-12 mb-0">
                                        <figure class="view overlay rounded z-depth-1 main-img">
                                            @if ($product->img_url)
                                                <img src="{{ asset('storage/' . $product->img_url) }}" class="img-fluid z-depth-1" width="300">
                                            @else  
                                                <img src="{{ asset('assets/img/fish-example.jpg') }}" class="img-fluid z-depth-1" width="300" />
                                            @endif
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $product->name }}</h5>
                            <p class="mb-2 text-muted text-uppercase medium">{{ $product->category->name }}</p>
                            <p>
                                <span class="mr-1"><strong>Rp. {{ number_format($product->price) }}</strong> /Kg</span>
                            </p>
                            <p class="mb-2">Tersedia {{ $product->stock }} Kg</p>
                            <p class="pt-1">{{ $product->description }}</p>
                            <hr/>                           
                            
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row mb-4">
                                    <div class="col-auto">
                                        <label class="col-form-label">Quantity (Kg)</label>
                                    </div>
                                    <div class="col-auto">
                                        <div class="def-number-input number-input safari_only mb-0">
                                            <input class="quantity form-control" min="1" name="quantity" value="1" type="number" max='{{ $product->stock }}' />
                                        </div>
                                    </div>
                                </div>
                                <x-button>
                                    <x-slot name="slot">Add to cart</x-slot>
                                </x-button> 
                            </form>
                        </div>
                    </div>
                    <div class="pt-24">
                        <h3><strong>Produk {{ $product->category->name }} Lainnya</strong></h3>
                    </div>
                </div>
                <div class="tab-pane fade show active pb-24" id="ikan" role="tabpanel">
                    <div class ="tab-single">
                        <div class="row flex justify-start">
                            @foreach ($anotherProduct as $product)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-10">
                                    <div class="single-product">
                                        <div class="product-img">
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
                                            </a>
                                            <div class="button-head">
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
            </section>
            <!--Section: Block Content-->
        </div>
    </x-slot>
</x-app-layout>