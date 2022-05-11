<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white-600 rounded-md font-medium text-semibold text-gray-400 hover:text-gray-700 tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>