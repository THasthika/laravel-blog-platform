<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-3 py-2 border-solid border-secondary border bg-primary text-gray-50 transition-colors hover:bg-secondary hover:text-gray-800 active:shadow-inner rounded']) }}>
    {{ $slot }}
</button>
