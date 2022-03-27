<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="header mb-16">
                <div class="pt-24 text-center">
                    <h1><strong>Your Profile</strong></h1>
                </div>
                <div>
                    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb" class="flex justify-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="no-underline text-blue-400 hover:no-underline">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>	
        </div>
        <div class="mb-20 flex justify-center">
            <div class="img text-center mr-12">
                <img src="{{ asset('assets/img/default-avatar.jpg') }}" style="width: 200px; clip-path:circle()" alt="">
                <h3 class="mt-3"><strong>{{ Auth::user()->name }}</strong></h3>
            </div>
            <div class="col-5">
                <form>
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Nama Lengkap</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3 ">
                            <label for="disabledTextInput" class="form-label">Username</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Email</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Nomor Telepon</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">Alamat</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="">
                        </div>
                    </fieldset>
                    <div class="flex justify-end">
                        <x-button>
                            <x-slot name="slot">
                                <a href="{{ route('profile.create') }}" class="no-underline text-white">
                                    Edit Profile
                                </a>
                            </x-slot>
                        </x-button>  
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
