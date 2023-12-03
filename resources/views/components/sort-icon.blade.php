@if ($field === $column)
    @if ($direction === 'asc')
        <i class="bi bi-arrow-up small"></i>
    @else
        <i class="bi bi-arrow-down small"></i>
    @endif
@else
    <i class="bi bi-arrow-down-up small"></i>
@endif
