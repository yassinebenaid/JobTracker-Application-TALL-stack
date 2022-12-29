<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-500 focus:bg-sky-500 active:bg-sky-700 focus:outline-none   transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
