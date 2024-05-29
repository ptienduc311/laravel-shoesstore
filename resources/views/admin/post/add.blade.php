@extends('layouts.admin')

@section('title', 'Thêm bài viết')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm bài viết mới</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open(['route' => 'post.store', 'method' => 'POST', 'files' => true, 'id' => 'form-upload-single']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề') !!}
                    {!! Form::text('title', old('title'), ['id' => 'title', 'class' => 'form-control']) !!}
                </div>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('content', 'Nội dung bài viết') !!}
                    {!! Form::textarea('content', old('title'), ['id' => 'content', 'class' => 'ckeditor']) !!}
                </div>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Hình ảnh') !!}
                    <img width="200" id="image">
                    {!! Form::file('image', [
                        'id' => 'laravel-image-upload',
                        'class' => 'form-control-file',
                    ]) !!}
                    {{-- {!! Form::hidden('image', '', ['id' => 'image_id']) !!} --}}
                </div>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <label for="">Danh mục bài viết</label>
                    <select class="form-control" id="" name="category_id">
                        <option value="">Chọn danh mục</option>
                        <?php
                            foreach ($categories as $category) {
                            ?>
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Trạng thái') !!}
                    <div class="form_check">
                        {!! Form::radio('status', 'published', '', ['id' => 'published', 'class' => 'form-check-input']) !!}
                        {!! Form::label('published', 'Công khai', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form_check">
                        {!! Form::radio('status', 'pending', '', ['id' => 'pending', 'class' => 'form-check-input']) !!}
                        {!! Form::label('pending', 'Chờ duyệt', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
