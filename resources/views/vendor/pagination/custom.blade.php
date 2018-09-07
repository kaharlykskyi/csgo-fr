@if ($paginator->hasPages())
    <div class="nk-pagination nk-pagination-left">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="nk-pagination-prev disabled">
                <span class="ion-ios-arrow-back"></span>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="nk-pagination-prev">
                <span class="ion-ios-arrow-back"></span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>...</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                <nav>
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="nk-pagination-current" href="#">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                </nav>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nk-pagination-next">
                <span class="ion-ios-arrow-forward"></span>
            </a>
        @else
            <a href="#" class="nk-pagination-next disabled">
                <span class="ion-ios-arrow-forward"></span>
            </a>
        @endif
    </div>
@endif