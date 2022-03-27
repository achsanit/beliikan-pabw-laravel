<link rel="stylesheet" href="{{ asset('css/productStyle/productStyle.css') }}">

<x-app-layout>
    <x-slot name='slot'>
        <div class="bg-white">
            <div class="carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/vide.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/vide.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/vide.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <section class="kategori">
                    <div class="container">
                        <div class="text-center mt-24 pb-16">
                            <h1><strong>Kategori Produk</strong></h1>
                            <p class="text-blue-600">Jenis Produk Jualan Nelayan</p>
                        </div>
                        <div class="row justify-center mb-10">
                            <div class="col-lg-2 mb-12 flex-column items-center">
                                <div class="flex sm:mx-10 sm:mt-1 justify-center">
                                    <img src="{{ asset('assets/img/fish.png') }}" class="img-fluid" alt="" width="90">
                                </div>
                                <div class="flex justify-center mt-4">
                                    <h5>Ikan</h5>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-12 flex-column">
                                <div class="sm:mx-12 flex justify-center">
                                    <img src="{{ asset('assets/img/udang.png') }}" class="img-fluid" alt="" width="75">
                                </div>
                                <div class="flex justify-center mt-3">
                                    <h5>Udang</h5>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-12 flex-column">
                                <div class="sm:mx-12 flex justify-center">
                                    <img src="{{ asset('assets/img/cumi.png') }}" class="img-fluid" alt="" width="75">
                                </div>
                                <div class="text-center mt-3">
                                    <h5>Cumi-cumi</h5>
                                </div>
                            </div>
                            <div class="col-lg-2 mb-12 flex-column">
                                <div class="sm:mx-12 flex justify-center">
                                    <img src="{{ asset('assets/img/kepiting.png') }}" class="img-fluid" alt="" width="75">
                                </div>
                                <div class="text-center mt-3">
                                    <h5>Kepiting</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="Product-terbaru">
                    <div class="title-produk-terbaru">
                        <div class="text-center mt-24 mb-12 sm:mt-24 sm:mb-8">
                            <h1><strong>Produk Terbaru</strong></h1>
                            <p class="text-blue-600">Ikan Segar Hasil Pancingan Nelayan Indonesia</p>
                        </div>
                    </div>
                    <div class="tab-pane fade show active mb-16" id="ikan" role="tabpanel">
                        <div class="tab-single">
                            <div class="row flex justify-center">
                                @foreach ($latestProducts as $product)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                        <div class="single-product">
                                            <div class="product-img border">
                                                <a href="{{ route('product.show',[$product->id]) }}">
                                                    @if ($product->img_url)
                                                        <div style="height: 150px; overflow:hidden; width: fit-content; " class="p-3">
                                                            <img class="img-fluid rounded-xl"  src="{{ asset('storage/' . $product->img_url) }}" alt="">
                                                        </div>
                                                    @else
                                                        <img class="img-fluid rounded-b-xl" src="{{ asset('assets/img/fish-example.jpg') }}" alt="">
                                                    @endif

                                                    @foreach ($latestProducts as $latest)
                                                        @if ($product->id == $latest->id)
                                                            <span class="new">New</span>
                                                        @endif
                                                    @endforeach
                                                </a>
                                                <!-- <div class="button-head">
                                                    <div class="product-action py-n3">
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
                                                    </div>
                                                    <div class="product-action-2 text-center pr-3 py-1">
                                                        <a title="Add to cart" href="" class="no-underline">Add to cart</a>
                                                    </div>
                                                </div> -->
                                                <div class="product-content text-center p-1 mb-5 mt-3">
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
                    <div class="button-more">
                        <div class="flex justify-center mt-6 mb-16">
                            <a href="{{ route('product.index') }}" class="no-underline">
                                <x-button>
                                    <x-slot name='slot'>Show All</x-slot>
                                </x-button>
                            </a>
                        </div>
                    </div>
                </section>
                <section class="about">
                    <div class="container">
                        <div class="row py-5">
                            <div class="col-lg-8 m-auto text-center">
                                <h1><strong>Kenapa Memilih Beliikan?</strong></h1>
                                <p class="text-blue-600">Beli Ikan Segar dengan Mudah</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- <img src="./img/woman.jpg" class="img-fluid mb-3" alt=""> -->
                                <h5>Kualitas Produk Terbaik</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error asperiores numquam iusto a eos odit adipisci qui consequuntur neque saepe.</p>
                            </div>
                            <div class="col-lg-4">
                                <!-- <img src="./img/gf.jpg" class="img-fluid mb-3" alt=""> -->
                                <h5>Pembayaran Mudah</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error asperiores numquam iusto a eos odit adipisci qui consequuntur neque saepe.</p>
                            </div>
                            <div class="col-lg-4">
                                <!-- <img src="./img/woman.jpg" class="img-fluid mb-3" alt=""> -->
                                <h5>Ikan Masih Segar</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error asperiores numquam iusto a eos odit adipisci qui consequuntur neque saepe.</p>
                            </div>
                        </div>
                        <div class="flex justify-center my-16">
                            <x-button>
                                <x-slot name='slot'>Shop More</x-slot>
                            </x-button>
                        </div>
                    </div>
                </section> 
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <script src="{{asset('template')}}/vendors/scripts/core.js"></script>
    </x-slot>
</x-app-layout>