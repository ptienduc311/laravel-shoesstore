@extends('layouts.admin')
@section('title', 'Thêm trang')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm trang mới</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open(['route' => 'page.store']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề') !!}
                    {!! Form::text('title', old('name'), ['class' => 'form-control', 'id' => 'title']) !!}
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Nội dung trang') !!}
                    {!! Form::textarea('content', old('name'), ['class' => 'ckeditor', 'id' => 'content']) !!}
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="cart">
                    <div class="form-group">
                        {!! Form::label('status', 'Trạng thái') !!}
                        <div class="form_check">
                            {!! Form::radio('status', 'published', '', ['class' => 'form-check-input', 'id' => 'published']) !!}
                            {!! Form::label('published', 'Công khai', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form_check">
                            {!! Form::radio('status', 'pending', '', ['class' => 'form-check-input', 'id' => 'pending']) !!}
                            {!! Form::label('pending', 'Chờ duyệt', ['class' => 'form-check-label']) !!}
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-danger" name="btn_add">Thêm mới</button>
                {!! Form::close() !!}
                </form>
            </div>
        </div>
    </div>
@endsection
