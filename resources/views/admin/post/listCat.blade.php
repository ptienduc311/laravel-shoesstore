@extends('layouts.admin')
@section('title', 'Danh mục bài viết')
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
                    <h3 id="index">Danh mục bài viết</h3>
                    <a href="{{ url('admin/post/cat/add') }}" title="" id="add-new">Thêm mới</a>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tên danh mục</span></td>
                                <td><span class="thead-text">Danh mục</span></td>
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
                                    <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            @if ($category->id != '1')
                                                <a href="{{ route('post_category.edit', $category->id) }}"
                                                    title="">{{ $category->category_name }}</a>
                                            @else
                                                <a title="" disabled>{{ $category->category_name }}</a>
                                            @endif
                                        </div>
                                        @if ($category->id != '1')
                                            <ul class="list-operation fl-right">
                                                <li><a href="{{ route('post_category.edit', $category->id) }}"
                                                        title="Sửa" class="edit"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></a></li>
                                                <li><a href="{{ route('post_category.delete', $category->id) }}"
                                                        title="Xóa" class="delete"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        @endif
                                    </td>
                                    <td><span class="tbody-text">Danh mục cha</span></td>
                                    <td><span class="tbody-text">{{ $category->created_by }}</span></td>
                                    <td><span class="tbody-text">{{ $category->created_at }}</span></td>
                                </tr>
                                @foreach ($category->children as $category2)
                                    <tr>
                                        <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title="">|--{{ $category2->category_name }}</a>
                                            </div>
                                            @if ($category2->id != '1')
                                                <ul class="list-operation fl-right">
                                                    <li><a href="{{ route('post_category.edit', $category2->id) }}"
                                                            title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="{{ route('post_category.delete', $category2->id) }}"
                                                            title="Xóa" class="delete"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            @endif
                                        </td>
                                        <td><span
                                                class="tbody-text">{{ $name_cat[$category2->parent_id]->category_name }}</span>
                                        </td>
                                        <td><span class="tbody-text">{{ $category2->created_by }}</span></td>
                                        <td><span class="tbody-text">{{ $category2->created_at }}</span></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                </div>
            </div>
        </div>
    </div>
@endsection
