<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white">
        <div class="pt-24 text-center">
            <h1><strong>Detail Order History</strong></h1>
        </div>
        <div>
            <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('history.index') }}" class="no-underline text-blue-400 hover:no-underline">History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
                </ol>
            </nav>
        </div>
        <section>
            <div class="container py-8">
                <div class="flex justify-center">
                    <div class="col-9">
                        <div class="">
                            <div class="title">
                                <h4><strong>Informasi Pembelian</strong></h4>
                            </div>
                            <div class="">
                                <table style="width:90%">
                                    <tr>
                                        <td>Nomor Pesanan</td>
                                        <td>: {{ $transaction->invoice_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {{ $transaction->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ $transaction->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td>: {{ $transaction->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: {{ $transaction->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembelian</td>
                                        <td>: {{ $transaction->created_at->toFormattedDateString() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pembelian</td>
                                        <td>: {{ $transaction->created_at->toTimeString() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembelian</td>
                                        <td>: IDR {{ $transaction->total_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>: {{ $transaction->payment_gateway }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>: {{ $transaction->status }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="col-9">
                        <div class="pt-8">
                            <div class="title">
                                <h4><strong>Detail Pembelian</strong></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2 flex justify-center">
                        <div class="cart-column pr-4 col-lg-9">
                            <table class="table table-borderless flex align-self-center align-middle">
                                <thead class="bg-primary text-white text-center mt-2">
                                    <tr class="">
                                        <th><h6>No</h6></th>
                                        <th><h6>Produk</h6></th>
                                        <th><h6>Nama Produk</h6></th>
                                        <th><h6>Kategori</h6></th>
                                        <th><h6>Jumlah Pembelian</h6></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="">
                                    @foreach ($products as $item)
                                        <tr class="border-bottom">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="table-plus">
                                                <div class="flex justify-center">
                                                    @if ($item->product ? $item->product->img_url : '')
                                                        <img src="{{ asset('storage/'. $item->product->img_url) }}" width="90" height="90" alt="">
                                                    @else
                                                        <img src="{{ asset('assets/img/fish-example.jpg') }}" width="90" height="90" alt="">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ $item->qty }} Kg</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

