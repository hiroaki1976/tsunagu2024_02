@extends('layouts.bbslayout')

@section('title', 'Tsunagu 投稿ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿ページの説明文')
@section('pageCss')
<link href="/css/bbs/style.css" rel="stylesheet">
@endsection

@include('layouts.bbsheader')

@section('content')
<div class="container mt-4">
    <div class="border p-4">
        <h1 class="h4 mb-4 font-weight-bold">
            投稿の新規作成
        </h1>

        <form method="POST" action="{{ route('bbs.store') }}">
            @csrf

            <fieldset class="mb-4">

                <div class="form-group">
                    <label for="subject">
                        名前
                    </label>
                    @php
                        $userName = '';
                        if (auth()->guard('web')->check()) {
                            $userName = auth()->guard('web')->user()->officename;
                        } elseif (auth()->guard('admin')->check()) {
                            $userName = auth()->guard('admin')->user()->officename;
                        }
                    @endphp

                    <input
                        id="officename"
                        name="officename"
                        class="form-control {{ $errors->has('officename') ? 'is-invalid' : '' }}"
                        value="{{ old('officename', $userName) }}"
                        type="text"
                        readonly
                    >

                    @if ($errors->has('officename'))
                        <div class="invalid-feedback">
                            {{ $errors->first('officename') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="subject">
                        カテゴリー
                    </label>
                    <select 
                        id="category_id"
                        name="category_id"
                        class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}"
                        value="{{ old('category_id') }}"
                    >
                        @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">
                        件名
                    </label>
                    <input
                        id="subject"
                        name="subject"
                        class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}"
                        value="{{ old('subject') }}"
                        type="text"
                    >
                    @if ($errors->has('subject'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message">
                        メッセージ
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}"
                        rows="4"
                    >{{ old('message') }}</textarea>
                    @if ($errors->has('message'))
                        <div class="invalid-feedback">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                </div>

                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ route('bbs.index') }}">
                        キャンセル
                    </a>

                    <button type="submit" class="btn btn-primary">
                        投稿する
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection

@include('layouts.bbsfooter')