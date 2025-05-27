<div class="sticky-top">
    <aside class="wrapper__list__article">
        <h4 class="border_section">
            Latest post
        </h4>
        <div class="wrapper__list__article-small">

            @foreach($mostViewedNews->take(1) as $item)
                <!-- Post Article -->
                <div class="article__entry" style="width: 100%">
                    <div class="article__image">
                        <a href="#">
                            <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="article__content" style="width: 100%">
                        <div class="article__category">
                            travel
                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ __('website.by') }} {{ $item->author->name }}
                                                    </span>
                            </li>
                            <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{ formatDate($item->created_at) }}
                                                    </span>
                            </li>

                        </ul>
                        <h5 class="text-wrap">
                            <a href="#">
                                {{$item->title}}
                            </a>
                        </h5>

                        <a href="#" class="btn btn-outline-primary mb-4 text-capitalize">
                            {{ __('website.read_more') }}
                        </a>
                    </div>
                </div>
            @endforeach

{{--            // from 2 to 3--}}
            @foreach($mostViewedNews->skip(1)->take(2) as $item)
                    <div class="mb-3">
                        <!-- Post Article -->
                        <div class="card__post card__post-list">
                            <div class="image-sm">
                                <a href="blog_details.html">
                                    <img src="{{ $item->image_url }}" class="img-fluid" alt="">
                                </a>
                            </div>

                            <div class="card__post__body ">
                                <div class="card__post__content">
                                    <div class="card__post__author-info mb-2">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    {{ __('website.by') }} {{ $item->author->name }}
                                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                                <span class="text-dark text-capitalize">
                                                                    {{ formatDate($item->created_at) }}
{{--                                                                    descember 09, 2016--}}
                                                                </span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card__post__title">
                                        <h6>
                                            <a href="blog_details.html">
                                                {{ truncate($item->title, 100) }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </aside>

    <aside class="wrapper__list__article">
        <h4 class="border_section">stay connected</h4>
        <!-- widget Social media -->
        <div class="wrap__social__media">
            @foreach($social_counts as $item)
                <a href="{{$item->url}}" target="_blank">
                    <div class="social__media__widget twitter" style="background: {{$item->color}}">
                        <span class="social__media__widget-icon">
                            <i class="{{$item->icon}}"></i>
                        </span>
                        <span class="social__media__widget-counter">
                            {{$item->fan_count}} {{$item->fan_type}}
                        </span>
                        <span class="social__media__widget-name">
                            {{$item->button_text}}
                        </span>
                    </div>
                </a>
            @endforeach

        </div>
    </aside>

    <aside class="wrapper__list__article">
        <h4 class="border_section">tags</h4>
        <div class="blog-tags p-0">
            <ul class="list-inline">

                @foreach($tags as $tag)
                    <li class="list-inline-item">
                        <a href="#">
                            #{{ $tag->name }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </aside>

    <aside class="wrapper__list__article">
        <h4 class="border_section">Advertise</h4>
        <a href="#">
            <figure>
                <img src="{{ asset('website_assets/images/newsimage3.png') }}" alt="" class="img-fluid">
            </figure>
        </a>
    </aside>

    <livewire:website.newsletter />

</div>
