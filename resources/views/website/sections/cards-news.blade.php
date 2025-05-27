<aside class="wrapper__list__article mt-5">
    <h4 class="border_section">{{ $category_name }}</h4>

    <div class="wrapp__list__article-responsive">
        @foreach($news as $item)
            <!-- Post Article List -->
            <div class="card__post card__post-list card__post__transition mt-30">
                <div class="row ">
                    <div class="col-md-5">
                        <div class="card__post__transition">
                            <a href="#">
                                <img src="{{ $item->image_url }}" class="img-fluid w-100" alt="{{ $item->title }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 my-auto pl-0">
                        <div class="card__post__body ">
                            <div class="card__post__content  ">
                                <div class="card__post__category ">
                                    {{ $category_name }}
                                </div>
                                <div class="card__post__author-info mb-2">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span class="text-primary">
                                                {{ __('website.by') }} {{ $item->author->name }}
                                            </span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-dark text-capitalize">
                                                {{ $item->created_at->format('F d, Y') }}
{{--                                                descember 09, 2016--}}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card__post__title">
                                    <h5>
                                        <a href="#">
                                            {{ truncate($item->title) }}
                                        </a>
                                    </h5>
                                    <p class="d-none d-lg-block d-xl-block mb-0">
                                        {!! truncate($item->content,130) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</aside>
