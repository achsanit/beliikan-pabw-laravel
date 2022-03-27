@extends("layouts.admin")

@section('title')
    Update Product
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('addproduct.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row flex justify-content-start">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <form action="{{ route('addproduct.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name">Nama Produk</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Ikan Lele" value="{{ $product->name }}" >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Produk</label>
                        <div class="">
                           <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>  
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$product->price}}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok (Kg)</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{$product->stock}}">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Gambar Produk</label>
                        <input class="form-control @error('img_url') is-invalid @enderror" type="file" id="img_url" name="img_url" value="{{$product->img_url}}">
                        @error('img_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description">{{$product->description}}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <x-button>
                        <x-slot name="slot">Update</x-slot>
                    </x-button>
                </form> 
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box  pd-20">
                <h1><strong>Update Produk </strong></h1> 
            </div>
        </div>
    </div>
@endsection