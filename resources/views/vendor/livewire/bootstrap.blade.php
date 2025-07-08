@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView({behavior: 'smooth'})
    JS
    : '';
@endphp

<div class="mx-auto">
    @if ($paginator->hasPages())
        <!-- Pagination -->
        <div class="pagination-area">
            <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        &laquo;
                    </a>
                @else
                    <a href="#" 
                       wire:click="previousPage('{{ $paginator->getPageName() }}')" 
                       x-on:click="{{ $scrollIntoViewJsSnippet }}"
                       wire:loading.attr="disabled"
                       dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                       rel="prev"
                       aria-label="@lang('pagination.previous')">
                        &laquo;
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a class="disabled" aria-disabled="true">{{ $element }}</a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a class="active" aria-current="page">{{ $page }}</a>
                            @else
                                <a href="#" 
                                   wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" 
                                   x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="#" 
                       wire:click="nextPage('{{ $paginator->getPageName() }}')" 
                       x-on:click="{{ $scrollIntoViewJsSnippet }}"
                       wire:loading.attr="disabled"
                       dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                       rel="next"
                       aria-label="@lang('pagination.next')">
                        &raquo;
                    </a>
                @else
                    <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        &raquo;
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
