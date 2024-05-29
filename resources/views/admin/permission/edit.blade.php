@extends('layouts.admin')

@section('title', 'Chỉnh sửa quyền')
@section('custom-css')
    <link href="{{ asset('admin_style/css/user/add_user.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div id="content" class="fl-right">
        <div id="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif
            <h2>CẬP NHẬT QUYỀN</h2>
            {!! Form::open(['route' => ['permission.update', $permission->id], 'method' => 'post']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Tên quyền') !!}
                {!! Form::text('name', $permission->name, ['class' => 'form-control', 'id' => 'name']) !!}
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                {!! Form::text('slug', $permission->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Mô tả') !!}
                {!! Form::textarea('description', $permission->description, [
                    'class' => 'form-control',
                    'id' => 'description',
                    'rows' => 3,
                ]) !!}
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit">Cập nhật</button>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection
