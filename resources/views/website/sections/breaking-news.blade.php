<!-- breaking news carousel-->
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapp__list__article-responsive wrapp__list__article-responsive-carousel">
                    @foreach($breakingNews as $article)
                        <div class="item">
                            <!-- Post Article -->
                            <div class="card__post card__post-list">
                                <div class="image-sm">
                                    <a href="{{ route('news.show', $article->slug) }}">
                                        <img src="{{ $article->image_url }}" class="img-fluid" alt="">
                                    </a>
                                </div>

                                <div class="card__post__body ">
                                    <div class="card__post__content">

                                        <div class="card__post__author-info mb-2">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{__('website.by')}} {{$article->author->name}}
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{--descember 09, 2016  as local language  --}}
                                                        {{ $article->created_at->diffForHumans() }}
                                                    </span>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="card__post__title">
                                            <h6>
                                                <a href="{{ route('news.show', $article->slug) }}"
                                                   style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $article->title }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Trending news carousel -->
