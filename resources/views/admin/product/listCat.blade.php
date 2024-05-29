@extends('layouts.admin')
@section('title', 'Danh mục sản phẩm')
@section('content')
    <div id="content" class="fl-right">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div id="card" class="mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between w-40">
                    <h3 id="index" class="fl-left">Danh mục sản phẩm</h3>
                    <a href="{{ url('admin/product/cat/add') }}" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tên danh mục</span></td>
                                <td><span class="thead-text">Thứ tự</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian tạo</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <td><span class="tbody-text">{{ $temp++ }}</span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $category->category_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{ route('product_category.edit', $category->id) }}" title="Sửa"
                                                    class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="{{ route('product_category.delete', $category->id) }}"
                                                    title="Xóa" class="delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $category->parent_id }}</span></td>
                                    <td><span class="tbody-text">{{ $category->created_by }}</span></td>
                                    <td><span class="tbody-text">{{ $category->created_at }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail clearfix">
            </div>
        </div>
    </div>
@endsection
