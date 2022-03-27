<x-app-layout>
    <div class="mt-24">
        <form action="{{ route('cart.update', $rowId) }}" method="post">
            @method('PUT')
            @csrf
            <input type="number" class="form-control" id="qty" name="qty">
            <x-button>
                <x-slot name="slot">update</x-slot>
            </x-button>
        </form>
    </div>
</x-app-layout>