@extends('layouts.admin')

@section('title', 'Page Title')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Chỉnh sửa slider</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open(['route' => ['slider.update', $slider->id], 'method' => 'POST', 'files' => true, 'id' => 'form-upload-single']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề slider') !!}
                    {!! Form::text('title', $slider->title, ['id' => 'title', 'class' => 'form-control']) !!}
                </div>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('link', 'Link') !!}
                    {!! Form::text('link', $slider->url, ['id' => 'link', 'class' => 'form-control']) !!}
                </div>
                @error('link')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('display_order', 'Thứ tự') !!}
                    {!! Form::text('display_order', $slider->display_order, ['id' => 'display_order', 'class' => 'form-control']) !!}
                </div>
                @error('display_order')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Hình ảnh') !!}
                    <img width="200" id="image" src="{{asset($image->src)}}">
                    {!! Form::file('image', [
                        'id' => 'laravel-image-upload',
                        'class' => 'form-control-file',
                    ]) !!}
                </div>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('status', 'Trạng thái', ['class' => 'form-check-label']) !!}
                    {!! Form::select('status', $options, $slider->status, ['id' => 'status','style' => 'width: 15% !important;']) !!}
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
