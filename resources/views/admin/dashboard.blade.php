@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beliikan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('content')
    @if (session('update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Yeaahh!</strong> {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 pb-5">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalTransactions }}</div>
                        <div class="font-14 text-secondary weight-500">Total Order</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-shopping-cart-1"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 pb-5">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalUsers }}</div>
                        <div class="font-14 text-secondary weight-500">Total User</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b"><i class="icon-copy dw dw-user1"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 pb-5">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalProducts }}</div>
                        <div class="font-14 text-secondary weight-500">Total Product</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="icon-copy dw dw-fish"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 pb-5">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalEarning }}</div>
                        <div class="font-14 text-secondary weight-500">Earning</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06"><i class="icon-copy fa fa-money" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($newOrder->count() > 0)
        <div class="card-box mb-30">
            <div class="flex justify-content-between">
                <div>
                    <h2 class="h4 pd-20">Pesanan Menunggu konfirmasi</h2>
                </div>
            </div>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Alamat</th>
                        <th>No Telp.</th>
                        <th>Total Pembelian</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newOrder as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->no_telp }}</td>
                            <td>IDR {{ $order->total_price }}</td>
                            <td>{{ $order->payment_gateway }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <!-- <div>
                                    <button class="btn btn-success p-1 px-2">
                                        <a class="" href="{{ route('transaction.show', $order->id) }}"><i class="icon-copy dw dw-eye"></i></a>
                                    </button>
                                    <button class="btn btn-success p-1 px-2">
                                        <a class="" href="{{ route('order.confirm', $order->id) }}"><i class="icon-copy ion-checkmark-round"></i></a>
                                    </button>
                                    <button class="btn btn-danger p-1 px-2">
                                        <form action="" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a class="" href="" 
                                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                <i class="icon-copy ion-close-round"></i>
                                            </a>
                                        </form>
                                    </button>
                                </div> -->
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('transaction.show', $order->id) }}"><i class="dw dw-eye"></i> Detail</a>
                                        <a class="dropdown-item" href="{{ route('order.confirm', $order->id) }}"><i class="icon-copy ion-checkmark-round"></i> Terima</a>
                                        <a class="dropdown-item" href="{{ route('order.reject', $order->id) }}"><i class="icon-copy ion-close-round"></i> Tolak</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="card-box mb-30">
        <div class="flex justify-content-between">
            <div>
                <h2 class="h4 pd-20">Produk Terbaru</h2>
            </div>
            <div class="d-flex align-items-center px-3 justify-content-end">
                <a href="{{ route('addproduct.create') }}"><button class="btn btn-primary">Tambah Produk</button></a>
            </div>
        </div>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <th class="datatable-nosort">Product</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newProduct as $product)
                    <tr>
                        <td class="">
                            @if ($product->img_url)
                                <img src="{{ asset('storage/'. $product->img_url) }}" width="70" height="70" alt="">
                            @else
                                <img src="{{ asset('assets/img/fish-example.jpg') }}" width="70" height="70" alt="">
                            @endif
                        </td>
                        <td>
                            <h5 class="font-16">{{ $product->name }}</h5>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>IDR {{ number_format($product->price) }}</td>
                        <td>{{ $product->stock }} Kg</td>
                        <td>
                            <div>
                                <button class="btn btn-warning p-1 px-2">
                                    <a class="text-white" href="{{ route('addproduct.edit', $product->id) }}"><i class="dw dw-edit2"></i></a>
                                </button>
                                <button type="button" class="btn btn-danger p-1 px-2">
                                    <a class="btn-block text-white" data-toggle="modal" data-target="#confirmation-modal_{{$product->id}}" type="button">
                                        <i class="dw dw-delete-3"></i>    
                                    </a>
                                </button>
                                <div class="modal fade" id="confirmation-modal_{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
								    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center font-18">
                                                <div class="flex justify-center pt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-exclamation-triangle-fill text-danger" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                </div>
                                                <h4 class="pt-3 mb-30 weight-500">Apakah anda yakin ingin menghapus <strong>{{ $product->name }}</strong> dari daftar produk?</h4>
                                                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                                    <div class="col-6"> 
                                                        <form action="{{ route('addproduct.destroy', $product->id) }}" method="post">
                                                            <button class="btn btn-danger border-radius-100 btn-block confirmation-btn">
                                                                @method('DELETE')
                                                                @csrf
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </form>
                                                        YES
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        NO
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
