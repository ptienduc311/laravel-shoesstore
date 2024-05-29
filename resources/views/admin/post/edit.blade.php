@extends('layouts.admin')

@section('title', 'Chỉnh sửa bài viết')
@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Chỉnh sửa viết mới</h3>
        </div>
    </div>
    <div class="section" id="detail-page">
        <div class="section-detail">
            {!! Form::open(['route' => ['post.update', $post->id], 'method' => 'POST', 'files' => true, 'id' => 'form-upload-single']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Tiêu đề') !!}
                {!! Form::text('title', $post->title, ['id' => 'title', 'class' => 'form-control']) !!}
            </div>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                {!! Form::label('content', 'Nội dung bài viết') !!}
                {!! Form::textarea('content', $post->content, ['id' => 'content', 'class' => 'ckeditor']) !!}
            </div>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                {!! Form::label('', 'Hình ảnh') !!}
                <img width="200" id="image" src="{{asset($image['src'])}}">
                {!! Form::file('image', [
                    'id' => 'laravel-image-upload',
                    'class' => 'form-control-file',
                ]) !!}
                {!! Form::hidden('image', '', ['id' => 'image_id']) !!}
            </div>
            @error('images')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                {!! Form::label('category_id', 'Danh mục cha') !!}
                {!! Form::select('category_id', $options, $post->category_id, ['class' => 'form-control']) !!}
            </div>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                {!! Form::label('', 'Trạng thái') !!}
                <div class="form_check">
                    {!! Form::radio('status', 'published', $post->status == 'published', ['id' => 'published', 'class' => 'form-check-input']) !!}
                    {!! Form::label('published', 'Công khai', ['class' => 'form-check-label']) !!}
                </div>
                <div class="form_check">
                    {!! Form::radio('status', 'pending', $post->status == 'pending', ['id' => 'pending', 'class' => 'form-check-input']) !!}
                    {!! Form::label('pending', 'Chờ duyệt', ['class' => 'form-check-label']) !!}
                </div>
            </div>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection