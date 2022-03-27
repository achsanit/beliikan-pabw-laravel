
<!-- <link rel="stylesheet" href="{{ asset('css/style_cart.css') }}"> -->

<div id="read-body">
    <x-app-layout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
            <div class="pt-24 text-center">
                <h1><strong>Your Cart</strong></h1>
            </div>
            <div>
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <section>
                <div class="container py-16">
                    <div class="row">
                        @if (Cart::count() > 0)
                            <div class="col-12 mb-5 flex justify-center">
                                <div class="cart-column pr-4 col-lg-8">
                                    @if (session('nostock'))
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </symbol>
                                        </svg>
                                        <div class="alert alert-danger flex alert-dismissible" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                {{ session('nostock') }}
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif
                                    <table class="table table-borderless flex align-self-center align-middle">
                                        <thead class="bg-primary text-white text-center mt-2">
                                            <tr class="">
                                                <th><h6>Item</h6></th>
                                                <th><h6>Nama Produk</h6></th>
                                                <th><h6>Harga</h6></th>
                                                <th><h6>Jumlah (Kg)</h6></th>
                                                <th><h6>Total Harga</h6></th>
                                                <th><h6>Remove</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" id="">
                                            
                                            @foreach (Cart::content() as $item)
                                                <tr class="border-bottom" id="">
                                                    <td class="table-plus">
                                                        <div class="flex justify-center">
                                                            @if ($item->model->img_url)
                                                                <img src="{{ asset('storage/'. $item->model->img_url) }}" width="90" height="90" alt="">
                                                            @else
                                                                <img src="{{ asset('assets/img/fish-example.jpg') }}" width="90" height="90" alt="">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>IDR {{ number_format($item->price) }}</td>
                                                    <td>
                                                        <div class="col-8 mx-auto">
                                                            <div class="def-number-input number-input safari_only mb-0">
                                                                <input type="hidden" id="rowId_{{$item->rowId}}" name="rowId" value="{{ $item->rowId }}">
                                                                <input class="qty_{{$item->rowId}} form-control" min="1" name="qty" id="qty_{{$item->rowId}}" value="{{ $item->qty }}" type="number" max='{{ $item->model->stock }}' />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="total_{{$item->rowId}}">
                                                        IDR {{ number_format($item->qty * $item->price) }}
                                                    </td>
                                                    <td>
                                                        <div class="flex justify-center mt-3">
                                                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="{{ route('cart.destroy', $item->rowId) }}"
                                                                                onclick="event.preventDefault();
                                                                                        this.closest('form').submit();">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                    </svg>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="summary col-lg-3 pl-4">
                                    <div class="p-3 border-2 rounded-2xl border-primary">
                                        <div class="text-center pb-3">
                                            <h5><strong>Cart Summary</strong></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                Total Berat
                                            </div>
                                            <div class="col flex justify-end">
                                                <div id="total_kg">{{ Cart::count() }}</div> 
                                                <div> Kg</div> 
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <strong>Total Harga</strong>
                                            </div>
                                            <div class="col flex justify-end">
                                                <strong>IDR {{ Cart::subtotal(0) }}</strong>
                                            </div>
                                        </div>
                                        <a href="{{ route('transaction.index') }}">
                                            <div class="pt-8 row px-3">
                                                <button class="btn btn-primary">Checkout</button>
                                            </div>
                                        </a>
                                        <div class="pt-2 row px-3 flex text-center">
                                            <p> 
                                                <a href="{{ route('product.index') }}" class="on-underline">
                                                    <button type="button" class="text-indigo-600 font-medium hover:text-indigo-500">Shopping More<span aria-hidden="true"> &rarr;</span></button>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="pb-12">
                                <div class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" class="bi bi-cart-plus text-gray-300" viewBox="0 0 16 16">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </div>
                                <div class="text-center pt-4 text-gray-400">
                                    <h4>Opss.. keranjang mu masih kosong</h4>
                                </div>
                                <div class="pt-4 flex justify-center">
                                    <a href="{{ route('product.index') }}" class="no-underline">
                                        <x-button>
                                            <x-slot name='slot'>Cari Produk</x-slot>
                                        </x-button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
        <script>

            $(document).ready(function(){
                <?php foreach(array($content) as $item){?>
                    <?php foreach($item as $key => $attribute){?>
                        $("#qty_<?php echo $key?>").change(function(){
                            const rowId = $("#rowId_<?php echo $key;?>").val();
                            const qty = $('.qty_'+rowId).val();
                            updateQty(rowId,qty)
                            const price = <?php echo $item[$key]->price ?>;
                            const total = price * qty
                            const nf = new Intl.NumberFormat('en-US')
                            $('#total_'+rowId).text('IDR '+ nf.format(total));
                            // alert(price * qty);
                            alert(berat);
                            // alert('#total_'+rowId)
                        });
                        
                    <?php }?>
                <?php }?>
            });

            function read() {
                $.get("{{ url('cart') }}", {}, function(data, status) {
                    $("#read-body").html(data);
                });
            }

            function updateQty(rowId,qty){
                $.ajax({
                    type : 'get',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url :"{{ url('updateCart') }}/"+rowId+"/"+qty,
                    data : "qty=" + qty + "& rowId=" + rowId,
                    success:function(data){
                        read();
                        // alert("tesss");
                    }
                })
            }
        </script>
        
    </x-app-layout>
</div>