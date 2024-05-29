@extends('layouts.admin')

@section('title', 'Thêm quyền')
@section('custom-css')
    <link href="{{ asset('admin_style/css/user/add_permission.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div id="content" class="fl-right">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Thêm quyền
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'permission.store']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Tên quyền') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug') !!}
                            <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                            {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'id' => 'slug']) !!}
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả') !!}
                            {!! Form::textarea('description', old('description'), [
                                'class' => 'form-control',
                                'id' => 'description',
                                'rows' => 4,
                            ]) !!}
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn-submit">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Danh sách quyền
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permissions as $moduleName => $modulePermissions)
                                    <tr class="table-primary">
                                        <td scope="row"></td>
                                        <td><strong class="text-uppercase">Module {{ ucfirst($moduleName) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($modulePermissions as $permission)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>|---{{ $permission->name }}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn edit"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('permission.delete', $permission->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn xóa bản ghi này?')"
                                                    class="btn delete" type="button" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
