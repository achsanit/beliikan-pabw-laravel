@extends("layouts.admin")

@section('title')
    Add Product
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('addproduct.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
@endsection

@section('content')
    <!-- <div class="card-box flex justify-center mb-20">
        <div class="col-lg-8 col-md-6 px-5">
            <form action="{{ route('addproduct.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Kategori Produk</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok (Kg)</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock">
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="img_url" class="form-label">Gambar Produk</label>
                    <input class="form-control @error('img_url') is-invalid @enderror" type="file" id="img_url" name="img_url">
                    @error('img_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description"></textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <x-button>
                    <x-slot name="slot">Create</x-slot>
                </x-button>
            </form> 
        </div>
    </div> -->
    <div class="row flex justify-content-start">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <form action="{{ route('addproduct.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group border-rounded">
                        <label for="name">Nama Produk</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Ikan Lele" >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Single Select</label>
                        <div>
                            <select class="selectpicker form-select" name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                    <option>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga (Rp)</label>
                        <input class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="25000" type="number">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok (Kg)</label>
                        <input class="form-control @error('stock') is-invalid @enderror" value="" id="stock" name="stock" type="number">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="img_url">Gambar Produk</label>
                        <input type="file" id="img_url" name="img_url" class="form-control-file form-control height-auto @error('img_url') is-invalid @enderror">
                        @error('img_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Produk</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"></textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <x-button>
                        <x-slot name="slot">Tambahkan</x-slot>
                    </x-button>
                </form>  -->
                <form action="{{ route('addproduct.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nama Produk</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Ikan Lele" >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Produk</label>
                        <div class="flex">
                           <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>  
                                @endforeach
                            </select> 
                            <!-- <div class="px-3 flex">
                                <a href="#" class="btn-block" data-backdrop="static" data-toggle="modal" data-target="#login-modal" type="button">
                                    <button type="button" class="btn btn-primary"><i class="icon-copy ion-plus-round"></i></button>
                                </a>
                                <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="login-box bg-white box-shadow border-radius-10">
                                                <div class="login-title">
                                                    <h2 class="text-center text-primary">Tambah Kategori</h2>
                                                </div>
                                                <form method="POST" action="{{ route('category.store') }}">
                                                    @csrf
                                                    <div class="input-group custom">
                                                        <input type="text" class="form-control form-control-lg" placeholder="Nama Kategori" name="name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group mb-0">
                                                                <button class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok (Kg)</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Gambar Produk</label>
                        <input class="form-control @error('img_url') is-invalid @enderror" type="file" id="img_url" name="img_url">
                        @error('img_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description"></textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <x-button>
                        <x-slot name="slot">Tambahkan</x-slot>
                    </x-button>
                </form> 
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box  pd-20">
                <h1><strong>Tambah Produk Baru</strong></h1> 
            </div>
        </div>
    </div>
@endsection