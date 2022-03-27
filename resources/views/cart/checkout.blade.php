<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
        <div class="pt-24 text-center">
            <h1><strong>Checkout</strong></h1>
        </div>
        <div>
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="no-underline text-blue-400 hover:no-underline">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
        <section>
            <div class="container p-10">
                <div class="bg-gray-100 rounded-xl border">
                    <form action="{{ route('transaction.store') }}" method="post">
                        @csrf
                        <div class="col-lg-12 col-md-8 mb-5 flex justify-center p-4">
                            <div class="cart-column pr-4 col-lg-8 py-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap </label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" >
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap </label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No. Telepon </label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp">
                                    @error('no_telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="summary col-lg-4 px-4 py-3 border">
                                <div class="text-center">
                                    <h6><strong>Pesanan Anda</strong></h6>
                                    <hr>
                                </div>
                                <div>
                                    @foreach ($cart as $item)
                                        <div class="row">
                                            <div class="col">
                                                {{ $item->name }} <span>{{ $item->qty }} Kg</span>
                                            </div>
                                            <div class="col flex justify-end">
                                                IDR {{ number_format($item->qty * $item->price) }}
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="row">
                                        <div class="col">
                                            Shipping
                                        </div>
                                        <div class="col flex justify-end">
                                            Free
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <strong>Subtotal</strong>
                                        </div>
                                        <div class="col flex justify-end">
                                            <strong>IDR {{ Cart::subtotal(0) }}</strong>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            Pembayaran
                                        </div>
                                        <div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check pt-2">
                                                <div>
                                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" value="COD">
                                                    <label class="form-check-label" for="flexRadioDisabled">
                                                        Cash On Delivery
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-check pt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" value="manual transfer">
                                                <label class="form-check-label" for="flexRadioCheckedDisabled">
                                                    Transfer Bank
                                                </label>
                                            </div>
                                            <div class="form-check pt-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" value="e-wallet">
                                                <label class="form-check-label" for="flexRadioCheckedDisabled">
                                                    E-Wallet
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-8 row px-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Checkout</strong></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <div class="flex justify-center pb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-question text-warning" viewBox="0 0 16 16">
                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h5>ingin melanjutkan pembayaran?</h5>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('transaction.store') }}">
                                                        <button class="btn btn-primary">Lanjut</button> 
                                                    </a>  
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>