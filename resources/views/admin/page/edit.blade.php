@extends('layouts.admin')
@section('title', 'Chỉnh sửa trang')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Chỉnh sửa trang</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open(['route' => ['page.update', $page->id], 'method'=>'post']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề') !!}
                    {!! Form::text('title', $page->title, ['class' => 'form-control', 'id' => 'title']) !!}
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Nội dung trang') !!}
                    {!! Form::textarea('content', $page->content, ['class' => 'ckeditor', 'id' => 'content']) !!}
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="cart">
                    <div class="form-group">
                        {!! Form::label('status', 'Trạng thái') !!}
                        <div class="form_check">
                            {!! Form::radio('status', 'published', $page->status === 'published', ['class' => 'form-check-input', 'id' => 'published']) !!}
                            {!! Form::label('published', 'Công khai', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form_check">
                            {!! Form::radio('status', 'pending', $page->status === 'pending', ['class' => 'form-check-input', 'id' => 'pending']) !!}
                            {!! Form::label('pending', 'Chờ duyệt', ['class' => 'form-check-label']) !!}
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-danger" name="btn_add">Cập nhật</button>
                {!! Form::close() !!}
                </form>
            </div>
        </div>
    </div>
@endsection
