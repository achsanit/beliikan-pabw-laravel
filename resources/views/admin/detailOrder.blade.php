<!-- @foreach ($detailProduct as $product)
    <h3>{{ $product->product ? $product->product ? $product->product->img_url : '' : '' }}</h3>
    <h3>{{ $product->qty }}</h3>
@endforeach -->

@extends('layouts.admin')

@section('title')
    Detail Order
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/order" class="text-decoration-none">Order</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card-box mb-30">
        <div class="flex justify-content-between">
            <div>
                <h2 class="h4 pd-20">Nomor Pesanan : {{ $transaction->invoice_number }}</h2>
            </div>
        </div>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th class="datatable-nosort">Product</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Jumlah beli</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailProduct as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="">
                            @if ($product->product ? $product->product->img_url : '')
                                <img src="{{ asset('storage/'. $product->product->img_url) }}" width="70" height="70" alt="">
                            @else
                                <img src="{{ asset('assets/img/fish-example.jpg') }}" width="70" height="70" alt="">
                            @endif
                        </td>
                        <td>
                            <h5 class="font-16">{{ $product->name }}</h5>
                        </td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->qty }} Kg</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
