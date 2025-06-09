@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div class="pagination-area">
    <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled">«</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" wire:navigate>«</a>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- Ellipsis -->
            @if (is_string($element))
                <a href="#" class="disabled">{{ $element }}</a>
            @endif

            <!-- Page Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" wire:navigate>{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" wire:navigate>»</a>
        @else
            <a href="#" class="disabled">»</a>
        @endif
    </div>
</div>
