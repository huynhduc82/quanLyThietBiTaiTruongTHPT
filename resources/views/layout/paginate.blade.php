@if ($paginator->hasPages())
    <nav class="pagination-container">
        <ul class="pagination d-block">
{{--             Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="pagination-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="pagination-item">
                    <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled" aria-disabled="true"><span class="pagination-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item is-active" aria-current="page"><span class="pagination-link">{{ $page }}</span></li>
                        @else
                            <li class="pagination-item"><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

{{--             Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item last">
                    <a class="pagination-link last" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="pagination-item last disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="pagination-link last" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    .pagination-container {
        text-align: center;
    }

    .pagination-item {
        list-style-type: none;
        display: inline-block;
        border-right: 1px solid #d7dadb;

        transform: scale(1) rotate(19deg) translateX(0px) translateY(0px) skewX(-10deg) skewY(-20deg);
    }

    .pagination-item:hover,
    .pagination-item.is-active {
        background-color: #fa4248;
        border-right: 1px solid #fff;
        color: #fff !important;
    }

    .pagination-item.last
    {
        border: none !important;
    }

    .pagination-link {
        padding: 1.1em 1.6em;
        display: inline-block;
        text-decoration: none;
        transform: scale(1) rotate(0deg) translateX(0px) translateY(0px) skewX(20deg) skewY(0deg);
    }
    .pagination-link:hover {
        color: #fff;
    }
    .pagination-link.last {
        border: none !important;
    }
</style>
