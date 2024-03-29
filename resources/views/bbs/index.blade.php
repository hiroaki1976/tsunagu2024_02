@extends('layouts.bbslayout')

@section('title', 'Tsunagu 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection

@include('layouts.bbsheader')

@section('content')
<!-- 検索フォーム -->
<div class="mt-4 mb-4">
    <form class="form-inline" method="GET" action="{{ route('bbs.index') }}">
        <div class="form-group">
            <input type="text" name="searchword" value="{{$searchword}}" class="form-control" placeholder="名前・件名・メッセージ">
        </div>
        <input type="submit" value="検索" class="btn btn-info ml-2">
    </form>
</div>
<div class="mt-4 mb-4">
    <a href="{{ route('bbs.create') }}" class="btn btn-primary">
        投稿の新規作成
    </a>
</div>
<div class="mt-4 mb-4">
    <a href="{{ route('dashboard') }}" class="btn btn-primary">
        ダッシュボードへ
    </a>
</div>
@if (session('poststatus'))
<div class="alert alert-success mt-4 mb-4">
    {{ session('poststatus') }}
</div>
@endif
<div class="mt-4 mb-4">
    <p>{{ $posts->total() }}件が見つかりました。</p>
</div>

<div class="mt-4 mb-4">
    @foreach($categories as $id => $name)
    <span class="btn"><a href="{{ route('bbs.index', ['category_id'=>$id]) }}" title="{{ $name }}">{{ $name }}</a></span>
    @endforeach
</div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>カテゴリ</th>
            <th>作成日時</th>
            <th>名前</th>
            <th>件名</th>
            <th>メッセージ</th>
            <th>処理</th>
        </tr>
        </thead>
        <tbody id="tbl">
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->category->name ?? '未分類' }}</td>
                    <td>{{ $post->created_at->format('Y.m.d') }}</td>
                    <td>{{ $post->officename }}</td>
                    <td>{{ $post->subject }}</td>
                    <td>{!! nl2br(e(Str::limit($post->message, 100))) !!}
                    @if ($post->comments->count() >= 1)
                        <p><span class="badge badge-primary">コメント：{{ $post->comments->count() }}件</span></p>
                    @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">詳細</a>
                        {{-- 編集・削除ボタン表示の条件分岐 --}}
                        @if(auth()->check() && (auth()->user()->id == $post->user_id || auth()->user()->is_admin == 1))
                        <p><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">編集</a></p>
                        <p>
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">削除</button>
                            </form>
                        @endif
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mb-5">
            {{ $posts->appends(['category_id' => $category_id,
            'searchword' => $searchword 
            ])->links() }}
        </div>
</div>
    @endsection
    
    @include('layouts.bbsfooter')