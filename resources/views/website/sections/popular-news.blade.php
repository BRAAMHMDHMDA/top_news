<aside class="wrapper__list__article">
    <h4 class="border_section">{{ __('website.popular_news') }}</h4>
    <div class="wrapper__list-number">

        @foreach($news as $index => $item)
        <!-- List Article -->
        <div class="card__post__list">
            <div class="list-number">
                <span>
                    {{ $index + 1 }}
                </span>
            </div>
            <a href="#" class="category">
                {{ $item->category->name }}
            </a>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <h5>
                        <a href="#" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                            {{ $item->title }}
                        </a>
                    </h5>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</aside>
