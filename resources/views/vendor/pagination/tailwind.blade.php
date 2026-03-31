@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center">
        <div class="flex flex-wrap items-center justify-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="rounded-full border border-primary-500 px-4 py-2 text-sm font-semibold text-primary-300 dark:border-white dark:text-gray-100">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="rounded-full border border-primary-500 bg-white px-4 py-2 text-sm font-semibold text-primary-500 transition hover:bg-primary-50 dark:border-white dark:bg-transparent dark:text-white dark:hover:bg-stone">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-sm text-gray-500 dark:text-gray-100">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="rounded-full border border-primary-500 bg-primary-500 px-4 py-2 text-sm font-semibold text-white dark:border-white dark:bg-white dark:text-gray-700">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="rounded-full border border-primary-500 bg-white px-4 py-2 text-sm font-semibold text-primary-500 transition hover:bg-primary-50 dark:border-white dark:bg-transparent dark:text-white dark:hover:bg-stone" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="rounded-full border border-primary-500 bg-white px-4 py-2 text-sm font-semibold text-primary-500 transition hover:bg-primary-50 dark:border-white dark:bg-transparent dark:text-white dark:hover:bg-stone">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="rounded-full border border-primary-500 px-4 py-2 text-sm font-semibold text-primary-300 dark:border-white dark:text-gray-100">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
