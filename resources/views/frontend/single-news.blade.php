@extends("frontend.Layouts.master")

@section('title')
    {{ $newss->title }}
@endsection

@section("content")
<div class="top"></div>
	<!-- single article section -->
	<div class="mt-100 mb-100">
		<div class="container">
			<div class="row">
                <div class="col-lg-8">
                    <div class="single-article-section">
                        <div class="single-article-text">
                            <img src="{{ asset($newss->image) }}" class="latest-news-bg w-100" style="height:350px !important;"/>
                            <p class="blog-meta">
                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                <span class="date"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $newss->created_at)->format('d F, Y') }}</span>
                            </p>
                            <h2>{{ $newss->title }}</h2>
                            <p>{!! strip_tags(html_entity_decode($newss->body)) !!}</p>
                            <p style="border-top: 1px dashed #0000003c"></p>
                            <div class="comment-template">
                                <form action="{{ route('news-comment.store') }}" method="POST">
                                    @csrf
                                    <p class="d-flex">
                                        <input type="text" name="content" placeholder="{{ __('words.leaveAComment') }}" class="col-9">
                                        <span class="col-1"></span>
                                        <input type="hidden" name="user_id" value="{{ Auth::user('web')->id }}">
                                        <input type="hidden" name="news_id" value="{{ $newss->id }}">
                                        <input type="submit" value="{{ __('words.submit') }}" class="col-2">
                                    </p>
                                </form>
                            </div>
                        </div>

                        <div class="comments-list-wrap">
                            @php
                                $totalComment = count(DB::table('comments')->where('news_id',$newss->id)->get());
                                $totalReply = count(DB::table('replies')->where('news_id',$newss->id)->get());
                                $total = $totalComment + $totalReply ;
                            @endphp
                            <h3 class="comment-count-title">{{ $total }} @if ($total > 1 ) {{ __('words.comments') }} @else {{ __('words.comment') }} @endif </h3>
                            <div class="comment-list">
                                @foreach (DB::table('comments')->where('news_id',$newss->id)->get() as $comment)
                                    {{-- {{ dd($comment) }} --}}
                                    <div class="single-comment-body">
                                        <div class="comment-user-avater">
                                            <img src="{{ asset(DB::table('users')->where('id', $comment->user_id)->pluck('profile_photo_path')->first()) }}" alt="">
                                        </div>
                                        <div class="comment-text-body">
                                            <h4>{{ DB::table('users')->where('id', $comment->user_id)->pluck('name')->first() }}
                                                <span class="comment-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->format('d F, Y - h:m A') }}</span>
                                                <a onclick="toggleInput({{ $comment->id }})">{{ __('words.reply') }}</a>
                                                <span style="margin: 10px;cursor: pointer;">
                                                    <a onclick="toggleInputUpdate({{ $comment->id }})">{{ __('words.edit') }}</a>
                                                    <a href="{{ route('comment.delete',$comment->id) }}">{{ __('words.delete') }}</a>
                                                </span>
                                            </h4>
                                            <p>{{ $comment->content }}</p>
                                            <form action="{{ route('news-comment.update',$comment->id) }}" method="POST" class="m-4" id="updateForm-{{ $comment->id }}" style="display: none">
                                                @csrf
                                                @method('put')
                                                <p class="d-flex">
                                                    <input type="text" name="content" value="{{ $comment->content }}" class="col-9">
                                                    <span class="col-1"></span>
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <input type="submit" value="{{ __('words.edit') }}" class="col-2">
                                                </p>
                                            </form>
                                            <form action="{{ route('news-reply.store') }}" method="POST" class="m-4" id="replyForm-{{ $comment->id }}" style="display: none">
                                                @csrf
                                                <p class="d-flex">
                                                    <input type="text" name="content" placeholder="{{ __('words.writeYourReply') }}" class="col-9">
                                                    <span class="col-1"></span>
                                                    <input type="hidden" name="user_id" value="{{ Auth::user('web')->id }}">
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <input type="hidden" name="news_id" value="{{ $newss->id }}">
                                                    <input type="submit" value="{{ __('words.submit') }}" class="col-2">
                                                </p>
                                            </form>
                                        </div>
                                        @foreach (DB::table('replies')->where('comment_id',$comment->id)->get() as $replay)
                                            <div class="single-comment-body child">
                                                <div class="comment-user-avater">
                                                    <img src="{{ asset(DB::table('users')->where('id', $replay->user_id)->pluck('profile_photo_path')->first()) }}" alt="">
                                                </div>
                                                <div class="comment-text-body">
                                                    <h4>{{ DB::table('users')->where('id', $replay->user_id)->pluck('name')->first() }} <span class="comment-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $replay->created_at)->format('d F, Y - h:m A') }}</span>
                                                        <span style="margin: 10px;cursor: pointer;">
                                                            <a onclick="toggleInputUpdateReply({{ $replay->id }})">{{ __('words.edit') }}</a>
                                                            <a href="{{ route('reply.delete',$replay->id) }}">{{ __('words.delete') }}</a>
                                                        </span>
                                                    </h4>
                                                    <p>{{ $replay->content }}</p>
                                                </div>
                                                <form action="{{ route('news-reply.update',$comment->id) }}" method="POST" class="m-4" id="updateReplyForm-{{ $replay->id }}" style="display: none">
                                                    @csrf
                                                    @method('put')
                                                    <p class="d-flex">
                                                        <input type="text" name="content" value="{{ $replay->content }}" class="col-9">
                                                        <span class="col-1"></span>
                                                        <input type="hidden" name="reply_id" value="{{ $replay->id }}">
                                                        <input type="submit" value="{{ __('words.edit') }}" class="col-2">
                                                    </p>
                                                </form>
                                            </div>
                                        @endforeach
                                        <script>
                                            function toggleInput(id) {
                                                var input = document.getElementById("replyForm-"+id);
                                                if (input.style.display === "none") {
                                                    input.style.display = "block";
                                                } else {
                                                    input.style.display = "none";
                                                }
                                            }
                                            function toggleInputUpdate(id) {
                                                var input = document.getElementById("updateForm-"+id);
                                                if (input.style.display === "none") {
                                                    input.style.display = "block";
                                                } else {
                                                    input.style.display = "none";
                                                }
                                            }
                                            function toggleInputUpdateReply(id) {
                                                var input = document.getElementById("updateReplyForm-"+id);
                                                if (input.style.display === "none") {
                                                    input.style.display = "block";
                                                } else {
                                                    input.style.display = "none";
                                                }
                                            }
                                        </script>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-section">
                        <div class="recent-posts">
                            <h4>{{ __('words.recentNews') }}</h4>
                            <ul>
                                @foreach ($titles as $key => $title)
                                    <li><a href="{{ route('news-read.show',$key) }}">{{ $title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
		    </div>
    	</div>
    </div>
	<!-- end single article section -->
@endsection
