@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border border-slate-300 focus:border-sky-500 focus:ring-0 focus:outline-0 rounded-md shadow-sm',
]) !!}>
