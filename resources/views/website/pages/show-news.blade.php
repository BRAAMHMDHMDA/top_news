<section class="pb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light mb-4">
                    <li class="breadcrumbs__item">
                        <a href="{{ route('home') }}" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> {{ __('website.home') }}</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="{{ route('news') }}" class="breadcrumbs__url">{{ __('website.news') }}</a>
                    </li>
                    <li class="breadcrumbs__item breadcrumbs__item--current">
                        {{ $news->title }}
                    </li>
                </ul>
                <!-- end breadcrumb -->
            </div>
            <div class="col-md-8">
                <!-- content article detail -->
                <!-- Article Detail -->
                <div class="wrap__article-detail">
                    <div class="wrap__article-detail-title">
                        <h1>
                            {{ $news->title }}
                        </h1>
                        {{--                        <h3>--}}
                        {{--                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae, hic.--}}
                        {{--                        </h3>--}}
                    </div>
                    <hr>
                    <div class="wrap__article-detail-info">
                        <ul class="list-inline d-flex flex-wrap justify-content-start">
                            <li class="list-inline-item">
                                {{ __('website.by') }}
                                <a href="#">
                                    {{ $news->author->name }} ,
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-dark text-capitalize ml-1">
                                    {{ formatDate($news->created_at) }}
                                </span>
                            </li>
                            <li class="list-inline-item">
                                    <span class="text-dark text-capitalize">
                                        {{ __('website.in') }}
                                    </span>
                                <a href="{{ route('news').'?category_id='.$news->category_id }}" target="_blank">
                                    {{ $news->category->name }}
                                </a>


                            </li>
                        </ul>
                    </div>

                    <div class="wrap__article-detail-image mt-4">
                        <figure>
                            <img src="{{ $news->image_url }}" alt="" class="img-fluid">
                        </figure>
                    </div>
                    <div class="wrap__article-detail-content">
                        <div class="total-views">
                            <div class="total-views-read">
                                <span>
                                    {{ __('website.views') }}:
                                </span>
                                15K
                            </div>

                            <ul class="list-inline">
                                <span class="share">{{ __('website.share') }} {{ __('website.on') }}:</span>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o facebook" href="#">
                                        <i class="fa fa-facebook-f"></i>
                                        <span>facebook</span>
                                    </a>

                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o twitter" href="#">
                                        <i class="fa fa-twitter"></i>
                                        <span>twitter</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o whatsapp" href="#">
                                        <i class="fa fa-whatsapp"></i>
                                        <span>whatsapp</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o telegram" href="#">
                                        <i class="fa fa-telegram"></i>
                                        <span>telegram</span>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a class="btn btn-linkedin-o linkedin" href="#">
                                        <i class="fa fa-linkedin"></i>
                                        <span>linkedin</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="max-w-full">
                            {!! $news->content !!}
                        </div>
                    </div>


                </div>
                <!-- end content article detail -->

                <!-- tags -->
                <!-- News Tags -->
                <div class="blog-tags">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-tags">
                            </i>
                        </li>
                        @foreach($news->tags as $tag)
                            <li class="list-inline-item">
                                <a href="#">
                                    #{{$tag->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- end tags-->

                <!-- authors-->
                <!-- Profile author -->
                <div class="wrap__profile">
                    <div class="wrap__profile-author">
                        <figure>
                            <img src="{{ asset('website_assets/images/logo2.png') }}" alt=""
                                 class="img-fluid rounded-circle">
                        </figure>
                        <div class="wrap__profile-author-detail">
                            <div class="wrap__profile-author-detail-name">{{ __('website.author') }} </div>
                            <h4>{{ $news->author->name }}</h4>
                            {{--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis laboriosam ad--}}
                            {{--                                beatae itaque ea non--}}
                            {{--                                placeat officia ipsum praesentium! Ullam?--}}
                            {{--                            </p>--}}
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social btn-social-o instagram ">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social btn-social-o telegram ">
                                        <i class="fa fa-telegram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social btn-social-o linkedin ">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end author-->

                <!-- Comment  -->
                <div id="comments" class="comments-area">
                    @auth('customer')
                        <h3 class="comments-title">{{ __('website.comments') }}({{ $this->comments->count() }}) :</h3>

                        <ol class="comment-list">
                            @foreach($this->comments as $comment)
                                <li class="comment">
                                    <aside class="comment-body">
                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
                                                <img src="" class="avatar" alt="image">
                                                <b class="fn">{{ $comment->customer->name }}</b>
                                                <span class="says">says:</span>
                                            </div>

                                            <div class="comment-metadata">
                                                <a href="#">
                                                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="comment-content">
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                        </div>

                                        <div class="reply">
                                            <a href="#" class="comment-reply-link" data-toggle="modal"
                                               data-target="#exampleModal"
                                               wire:click="$set('parent_id', {{ $comment->id }})"
                                            >
                                                Reply
                                            </a>

                                            {{-- user can delete comment if he is the author of the comment or he write the comment --}}
                                            @if(auth('customer')->user()->id == $comment->customer_id || auth('customer')->user()->id == $news->user_id)
                                                <span wire:click="deleteComment({{ $comment->id }})"><i
                                                        class="fa fa-trash"></i></span>
                                            @endif

                                        </div>
                                    </aside>

                                    @if($comment->replies()->count() > 0)
                                        <ol class="children">
                                            @foreach($comment->replies as $reply)
                                                <li class="comment">
                                                    <aside class="comment-body">
                                                        <div class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <img src="" class="avatar" alt="image">
                                                                <b class="fn">{{ $reply->customer->name }}</b>
                                                                <span class="says">says:</span>
                                                            </div>

                                                            <div class="comment-metadata">
                                                                <a href="#">
                                                                    <span>
                                                                        {{ $reply->created_at->diffForHumans() }}
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="comment-content d-flex justify-content-between">
                                                            <p class="">{{ $reply->comment }}</p>
                                                            <div class="reply col-1 align-items-start mt-0 "
                                                                 style="max-width: fit-content">
                                                                @if(auth('customer')->user()->id == $reply->customer_id || auth('customer')->user()->id == $news->user_id)
                                                                    <span wire:click="deleteComment({{ $reply->id }})"
                                                                          wire:loading.remove
                                                                          wire:target="deleteComment({{ $reply->id }})"><i
                                                                            class="fa fa-trash"></i></span>
                                                                    {{--                                                                    <span ><i class="fa fa-trash"></i></span>--}}
                                                                    <span
                                                                        class="spinner-border spinner-border-sm text-white ms-1"
                                                                        role="status" wire:loading
                                                                        wire:target="deleteComment({{ $reply->id }})">
                                                                    </span>

                                                                @endif
                                                            </div>
                                                        </div>
                                                    </aside>


                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>

                            @endforeach

                            <div class="mt-4">
                                @if($this->comments->hasPages())
                                    {{ $this->comments->links() }}
                                @endif

                            </div>

                            {{--                            <li class="comment">--}}
                            {{--                                <aside class="comment-body">--}}
                            {{--                                    <div class="comment-meta">--}}
                            {{--                                        <div class="comment-author vcard">--}}
                            {{--                                            <img src="images/news4.jpg" class="avatar" alt="image">--}}
                            {{--                                            <b class="fn">Sinmun</b>--}}
                            {{--                                            <span class="says">says:</span>--}}
                            {{--                                        </div>--}}

                            {{--                                        <div class="comment-metadata">--}}
                            {{--                                            <a href="#">--}}
                            {{--                                                <span>April 24, 2019 at 10:59 am</span>--}}
                            {{--                                            </a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                    <div class="comment-content">--}}
                            {{--                                        <p>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s,--}}
                            {{--                                            when an unknown--}}
                            {{--                                            printer took a galley of type and scrambled it to make a type specimen book.--}}
                            {{--                                        </p>--}}
                            {{--                                    </div>--}}

                            {{--                                    <div class="reply">--}}
                            {{--                                        <a href="#" class="comment-reply-link" data-toggle="modal"--}}
                            {{--                                           data-target="#exampleModal">Reply</a>--}}
                            {{--                                        <span>--}}
                            {{--                                            <i class="fa fa-trash"></i>--}}
                            {{--                                        </span>--}}
                            {{--                                    </div>--}}
                            {{--                                </aside>--}}
                            {{--                            </li>--}}
                        </ol>

                        <div class="comment-respond">
                            <h3 class="comment-reply-title">{{__('website.leave')}} {{__('website.comment')}}</h3>

                            <form class="comment-form" wire:submit.prevent="submit">
                                {{--                                <p class="comment-notes">--}}
                                {{--                                    <span id="email-notes">Your email address will not be published.</span>--}}
                                {{--                                    Required fields are marked--}}
                                {{--                                    <span class="required">*</span>--}}
                                {{--                                </p>--}}
                                <p class="comment-form-comment">
                                    {{--                                    <label for="comment">Comment</label>--}}
                                    <textarea name="comment" id="comment" cols="45" rows="5" maxlength="65525"
                                              required="required" wire:model="comment"
                                              wire:click="$set('parent_id', null)"></textarea>
                                </p>
                                <p class="form-submit mb-0">
                                    {{--                                    <input type="submit" name="submit" id="submit" class="submit" value="Post Comment" >--}}
                                    <x-submit-btn
                                        class="btn btn-primary">{{ __('website.submit') }}</x-submit-btn>
                                </p>
                            </form>
                        </div>
                    @else
                        <div class="comment-respond">
                            <h5>
                                @if(app()->getLocale() == 'ar')
                                    يرجى <a href="{{ route('login') }}">تسجيل الدخول</a> لإضافة تعليق على هذا الخبر
                                @else
                                    Please <a href="{{ route('login') }}">Login</a> to Comment on this Article!
                                @endif
                            </h5>
                        </div>
                    @endauth
                </div>

                <!-- Modal -->
                <div class="comment_modal" wire:submit="submit" wire:ignore>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Write Your Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#">
                                        <textarea cols="30" rows="7" placeholder="Type. . ."
                                                  wire:model="comment"></textarea>
                                        <x-submit-btn>{{ __('website.submit') }}</x-submit-btn>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- end comment -->

                <div class="row">
                    <div class="col-md-6">
                        @if($previousPost)
                            <div class="single_navigation-prev">
                                <a href="{{ route('news.show', $previousPost->slug) }}">
                                    <span>{{ __('website.previous_post') }}</span>
                                    {{ $previousPost->title }}
                                </a>
                            </div>
                        @else
                            <div class="single_navigation-prev">
                                <a href="javascript:void();">
                                    <span>{{ __('website.previous_post') }}</span>
                                    <span style="color: black">{{ __('website.no_previous_news') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($nextPost)
                            <div class="single_navigation-next text-left text-md-right">
                                <a href="{{ route('news.show', $nextPost->slug) }}">
                                    <span>{{ __('website.next_post') }}</span>
                                    {{ $nextPost->title }}
                                </a>
                            </div>
                        @else
                            <div class="single_navigation-next text-left text-md-right">
                                <a href="javascript:void();">
                                    <span>{{ __('website.next_post') }}</span>
                                    <span style="color: black">{{ __('website.no_next_news') }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="small_add_banner mb-5 pb-4">
                    <div class="small_add_banner_img">
                        <img src="{{ asset('website_assets/images/placeholder_large.jpg') }}" alt="adds">
                    </div>
                </div>


                <div class="clearfix"></div>

                @if(count($relatedPosts))
                    <div class="related-article">
                        <h4>
                            {{ __('website.you_may_also_like') }}
                        </h4>

                        <div class="article__entry-carousel-three">
                            @foreach($relatedPosts as $item)
                                <div class="item">
                                    <!-- Post Article -->
                                    <div class="article__entry">
                                        <div class="article__image">
                                            <a href="{{ route('news.show', $item->slug) }}">
                                                <img src="{{ $item->image_url }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="article__content">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                <span class="text-primary">
                                                    {{ __('website.by') }} {{ $item->author->name }}
                                                </span>
                                                </li>
                                                <li class="list-inline-item">
                                                <span>
                                                    {{ formatDate($item->created_at) }}
                                                </span>
                                                </li>

                                            </ul>
                                            <h5>
                                                <a href="{{ route('news.show', $item->slug) }}">
                                                    {{ truncate( $item->title, 80 ) }}
                                                </a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-md-4">
                <x-website.sidebar/>
            </div>

        </div>
    </div>
</section>

{{-- close modal when dispatch closeModal event --}}
@script
<script>
    Livewire.on('closeModal', () => {
        $('#exampleModal').modal('hide');
    });
</script>
@endscript
