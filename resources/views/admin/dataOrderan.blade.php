@extends('layouts.admin')

@section('title')
    Data Orderan
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Orderan</li>
        </ol>
    </nav>
@endsection

@section('content')
    @if ($confirm->count() > 0)
        <div class="card-box mb-30">
            <div class="flex justify-content-between">
                <div>
                    <h2 class="h4 pd-20">Menunggu Konfirmasi</h2>
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
                    @foreach ($confirm as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->no_telp }}</td>
                            <td>Rp {{ $order->total_price }}</td>
                            <td>{{ $order->payment_gateway }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="{{ route('transaction.show', $order->id) }}"><i class="dw dw-eye"></i> Detail</a>
                                            <a class="dropdown-item" href="{{ route('order.confirm', [ 'id' => $order->id]) }}"><i class="icon-copy ion-checkmark-round"></i> Terima</a>
                                            <a class="dropdown-item" href="{{ route('order.reject', $order->id) }}"><i class="icon-copy ion-close-round"></i> Tolak</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($shipping->count() > 0)
        <div class="card-box mb-30">
            <div class="flex justify-content-between">
                <div>
                    <h2 class="h4 pd-20">Dalam Pengiriman</h2>
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
                    @foreach ($shipping as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->no_telp }}</td>
                            <td>Rp {{ $order->total_price }}</td>
                            <td>{{ $order->payment_gateway }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('transaction.show', $order->id) }}"><i class="dw dw-eye"></i> Detail</a>
                                        <a class="dropdown-item" href="{{ route('order.arrived', [ 'id' => $order->id]) }}"><i class="icon-copy ion-checkmark-round"></i> Sampai</a>
                                        <a class="dropdown-item" href="{{ route('order.reject', $order->id) }}"><i class="icon-copy ion-close-round"></i> Cancel</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($arrived->count() > 0)
        <div class="card-box mb-30">
            <div class="flex justify-content-between">
                <div>
                    <h2 class="h4 pd-20">Pesanan Selesai</h2>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrived as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->no_telp }}</td>
                            <td>Rp {{ $order->total_price }}</td>
                            <td>{{ $order->payment_gateway }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <button class="btn btn-success p-1 px-2">
                                    <a class="" href="{{ route('transaction.show', $order->id) }}"><i class="icon-copy dw dw-eye"></i></a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($cancel->count() > 0)
        <div class="card-box mb-30">
            <div class="flex justify-content-between">
                <div>
                    <h2 class="h4 pd-20">Pesanan dibatalkan</h2>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cancel as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->no_telp }}</td>
                            <td>Rp {{ $order->total_price }}</td>
                            <td>{{ $order->payment_gateway }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <button class="btn btn-success p-1 px-2">
                                    <a class="" href="{{ route('transaction.show', $order->id) }}"><i class="icon-copy dw dw-eye"></i></a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
