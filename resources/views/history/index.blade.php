<!-- <link rel="stylesheet" href="{{ asset('css/style_cart.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/productStyle/productStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/productStyle/themify-icons.css') }}">

<x-app-layout>
    @if (session('success'))
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
        <div class="modal fade" id="success-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Checkout Berhasil !!!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="flex justify-center pt-2 pb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check2-all text-success" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h5>Terima kasih telah membeli produk kami...</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
        <div class="pt-24 text-center">
            <h1><strong>Order History</strong></h1>
        </div>
        <div>
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>
        <section>
            @if ($count > 0)
                <div class="tab-pane fade show active pb-16" id="ikan" role="tabpanel">
                    <div class="tab-single">
                        <div class="row flex justify-center">
                            @foreach ($history as $item)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-10">
                                    <div class="single-product">
                                        <div class="product-img border">
                                            <div class="img"></div>
                                            <a href="{{ route('history.show', $item->id) }}" class="no-underline text-black">
                                                <div class="flex justify-center py-3">
                                                    @if ($item->status == 'selesai')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16">
                                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                        </svg>
                                                    @elseif ($item->status == 'proses')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-truck text-warning" viewBox="0 0 16 16">
                                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                                        </svg>
                                                    @elseif ($item->status == 'batal')
                                                        <div class="py-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="112" height="112" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </div>
                                                    @elseif ($item->status == 'pending')
                                                        <div class="py-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="112" height="112" fill="currentColor" class="bi bi-clock-history text-primary" viewBox="0 0 16 16">
                                                                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                                                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="product-content mx-3 mb-3 mt-3 ">
                                                    <h5><strong>{{ $item->name }}</strong></h5>
                                                    <div>IDR {{ $item->total_price }}</div>
                                                    <div>{{ $item->created_at->toFormattedDateString() }}</div>
                                                    <!-- <div>{{ $item->created_at->toTimeString() }}</div> -->
                                                    <div>{{ $item->status }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="py-20">
                    <div class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" class="bi bi-bag-plus text-gray-300" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                    </div>
                    <div class="text-center pt-4 text-gray-400">
                        <h4>Opss.. kamu belum pernah order</h4>
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
        </section>
    </div>
</x-app-layout>