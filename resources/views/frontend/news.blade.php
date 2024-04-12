@extends("frontend.Layouts.master")

@section('title')
    {{ __('words.allNews') }}
@endsection

@section("content")
<div class="top"></div>
<div class="latest-news pt-150 pb-150">
		<div class="container">
			<div class="row">
                @foreach ($newss as $news)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-news">
                            <a href="{{ route('news-read.show',$news->id) }}">
                                <img src="{{ $news->image }}" class="latest-news-bg w-100"/>
                            </a>
                            <div class="news-text-box">
                                <h3><a href="{{ route('news-read.show',$news->id) }}">{{ $news->title }}</a></h3>
                                <p class="blog-meta">
                                    <span class="author"><i class="fas fa-user"></i> Admin</span>
                                    <span class="date"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->format('d F, Y') }}</span>
                                </p>
                                <p class="excerpt">{!! strip_tags(html_entity_decode($news->body)) !!}</p>
                                <a href="{{ route('news-read.show',$news->id) }}" class="read-more-btn">{{ __('words.readmore') }} <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
			</div>
		</div>
	</div>
@endsection
