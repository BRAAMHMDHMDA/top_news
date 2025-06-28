<div>
    <section class="blog_pages">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('home') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> {{ __('website.home') }}</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            {{ __('website.news') }}
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="blog_page_search">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-8">
                                    <input type="text" placeholder="{{ __('website.search_by_title') }}"
                                           wire:model.live.debounce="search">
                                </div>
                                <div class="col-lg-4">
                                    <select wire:model.live.debounce="category_id">
                                        <option value={{null}} >{{ __('website.select_category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </form>
                    </div>

                    <aside class="wrapper__list__article ">

                        @if($category_id != null)
                            <h4 class="border_section"
                                wire:loading.remove>{{$categories->find($category_id)->name}}</h4>
                        @endif

                        <div class="spinner-border text-primary mb-4" role="status" wire:loading>
                            <span class="sr-only">Loading...</span>
                        </div>

                        <div class="row">
                            {{--                          is $news empty alert not data--}}
                            @forelse($news as $item)
                                <div class="col-lg-6">

                                    <!-- Post Article -->
                                    <div class="article__entry" style="width: 100%">
                                        <div class="article__image">
                                            <a href="{{ route('news.show', $item->slug) }}">
                                                <img src="{{ $item->image_url}}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content" style="width: 100%">
                                            <a class="article__category"
                                               href="{{route('news')}}?category_id={{ $item->category->id }}"
                                               style="text-decoration: none;">
                                                {{ $item->category->name }}
                                            </a>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                <span class="text-primary">
                                                    {{ __('website.by') }} {{ $item->author->name }}
                                                </span>
                                                </li>
                                                <li class="list-inline-item">
                                                <span class="text-dark text-capitalize">
                                                    {{ date_format($item->created_at, 'F d, Y') }}
                                                </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news.show', $item->slug) }}" style="height: 40px;">
                                                    {{ truncate($item->title, 55) }}
                                                </a>
                                            </h5>
                                            <div
                                                style="height: 50px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; margin-bottom: 10px">
                                                {!!$item->content!!}
                                            </div>
                                            <a href="{{ route('news.show', $item->slug) }}"
                                               class="btn btn-outline-primary mb-4 text-capitalize">{{ __('website.read_more') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning px-5 mx-auto">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    {{ __('website.not_data') }}
                                </div>
                            @endforelse
                        </div>

                    </aside>

                </div>

                <div class="col-md-4">
                    <x-website.sidebar/>
                </div>
                <div class="clearfix"></div>
            </div>

            @if($news->hasPages())
                <div class="row">
                    <div class="col-md-12">
                        {{ $news->links() }}
                    </div>
                </div>
            @endif

        </div>

        <!-- AD -->
        @if($ad_news_page)
            <div class="large_add_banner">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <a class="large_add_banner_img" href="{{ $ad_news_page->url }}" target="_blank">
                                <img src="{{ $ad_news_page->image_url }}" alt="adds">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>


</div>
