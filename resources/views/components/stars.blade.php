@props(['stars' => 0])
<div>
    @foreach (range(1, 5) as $item)
        <i class="bi bi-star{{ $loop->iteration <= $stars ? '-fill' : '' }} text-sky-600  "></i>
    @endforeach
</div>
