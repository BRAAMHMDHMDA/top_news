<div class="container">
    <div class="row">
        <div class="col-md-12">
            <aside class="wrapper__list__article">
                <h4 class="border_section">{{ $category_name }}</h4>
            </aside>
        </div>
        <div class="col-md-12">

            <div class="article__entry-carousel">
                @foreach($news as $item)
                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="#">
                                    <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{__('website.by')}} {{ $item->author->name }}
                                            </span>
                                    </li>
                                    <li class="list-inline-item">
                                            <span>
                                                {{ $item->created_at->format('M d, Y') }}
{{--                                                descember 09, 2016--}}
                                            </span>
                                    </li>

                                </ul>
                                <h5 style="font-size: 16px">
                                    <a href="#">
                                        {{ truncate($item->title) }}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
