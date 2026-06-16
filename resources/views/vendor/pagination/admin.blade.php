@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <p class="pagination-info">
            Showing
            <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            results
        </p>

        <nav class="pagination-nav" aria-label="Pagination">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true">
                        <span>&lsaquo; Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo; Previous</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &rsaquo;</a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true">
                        <span>Next &rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
