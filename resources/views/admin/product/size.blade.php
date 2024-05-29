@extends('layouts.admin')
@section('title', 'Quản lý size giày')
@section('content')
    <div id="content" class="fl-right">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container-size-shoes">
            <h2>Quản lý Size Giày</h2>

            {!! Form::open(['route' => 'size.store', 'class' => 'size-form']) !!}
            {!! Form::text('size', old('size'), ['class' => 'size-input']) !!}
            {!! Form::submit('THÊM', ['class' => 'add-button']) !!}
            {!! Form::close() !!}
            @error('size')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <ul class="size-list">
                @foreach ($sizes as $size)
                    <li class="size-list-item">{{$size->name}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('admin_style/css/import/size_product.css') }}">
@endsection
