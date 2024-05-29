@extends('layouts.admin')

@section('title', 'Thêm vai trò')
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
            <h2>THÊM VAI TRÒ</h2>
            {!! Form::open(['route'=>'role.store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Tên vai trò') !!}
                        {!! Form::text('name', old('name'), ['class'=>'form-control', 'id'=>'name']) !!}
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Mô tả') !!}
                        {!! Form::textarea('description', old('description'), ['class'=>'form-control', 'id'=>'description', 'rows'=>3]) !!}
                        @error('description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <strong class="d-block">Vai trò này có quyền gì?</strong>
                    <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn
                        quyền.</small>
                    @foreach ($permissions as $moduleName => $modulePermissions)
                        <div class="card my-4 border">
                            <div class="card-header">
                                {!! Form::checkbox(null, null, null, ['class'=>'check-all', 'id'=>$moduleName]) !!}
                                {!!html_entity_decode(Form::label($moduleName, '<strong>Module ' .ucfirst($moduleName). '</strong>'))!!}
                            </div>
                            <div class="card-body">
                                <div class="row ">
                                    @foreach ($modulePermissions as $permission)
                                        <div class="col-md-3">
                                            {!! Form::checkbox('permission_id[]', $permission->id, null, ['id'=>$permission->slug, 'class'=>'permission '. $moduleName]) !!}
                                            {!! Form::label($permission->slug, $permission->name) !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @error('permission_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                <div class="form-group">
                    <button type="submit">Thêm mới</button>
                </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection