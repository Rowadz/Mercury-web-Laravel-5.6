@if ($paginator->hasPages())
<div class="ui pagination menu paginationMargin">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">
                        <i class="chevron left icon disabled"></i>
                </span>
            </a>
        @else
                <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="chevron left icon "></i>
                </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="item disabled" aria-disabled="true"><span >{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active" aria-current="page"><span class="page-link">{{ $page }}</span></a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            
                <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="chevron right icon "></i>
                </a>   
        @else
            <a class="item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                        <i class="chevron right icon disabled"></i>
                </span>
            </a>
        @endif
    </div>
@endif
