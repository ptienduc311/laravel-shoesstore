@extends('layouts.admin')

@section('title', 'Thêm danh mục bài viết')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm danh mục sản phẩm</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open(['route' => 'post_category.store']) !!}
                <div class="form-group">
                    {!! Form::label('category_name', 'Tên danh mục sản phẩm') !!}
                    {!! Form::text('category_name', old('category_name'), ['class' => 'form-control', 'id' => 'category_name']) !!}
                    @error('category_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_desc', 'Mô tả ngắn') !!}
                    {!! Form::textarea('category_desc', old('category_desc'), ['class' => 'ckeditor', 'id' => 'category_desc']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('parent_id', 'Danh mục cha') !!}
                    <span style="font-style: italic; opacity: 0.5;">(Không chọn mặc định là danh mục cha)</span>
                    {!! Form::select('parent_id', $options, '', ['class' => 'form-control']) !!}
                </div>
                <button type="submit" name="btn_add" id="btn_dd">Thêm danh mục</button>
                {!! Form::close() !!}
                </form>
            </div>
        </div>
    </div>
@endsection
