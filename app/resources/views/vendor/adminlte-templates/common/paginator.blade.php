@if ($paginator->hasPages())
    <ul class="pagination m-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">«</span>
            </li>
        @else
            <li class="page-item">
                <button class="page-link" page-number="{{ $paginator->currentPage() - 1 }}" rel="prev"
                   aria-label="@lang('pagination.previous')">«</button>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><button class="page-link" page-number="{{ $page }}">{{ $page }}</button></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button class="page-link" page-number="{{ $paginator->currentPage() + 1 }}" rel="next"
                   aria-label="@lang('pagination.next')">»</button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">»</span>
            </li>
        @endif
    </ul>
@endif
