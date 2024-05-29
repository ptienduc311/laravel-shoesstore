@extends('layouts.admin')

@section('title', 'Danh sách trang')
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
                    <h3 id="index">Danh sách trang</h3>
                    <a href="{{ route('page.add') }}" title="" id="add-new">Thêm mới</a>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tiêu đề</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian tạo</span></td>
                                <td><span class="thead-text">Thời gian sửa đổi</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $temp = 1;
                            ?>
                            @foreach ($pages as $page)
                                <tr>
                                    <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $page->title }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{ route('page.edit', $page->id) }}" title="Sửa"
                                                    class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="{{ route('page.delete', $page->id) }}" title="Xóa"
                                                    class="delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $page->status }}</span></td>
                                    <td><span class="tbody-text">{{ $page->created_by }}</span></td>
                                    <td><span class="tbody-text">{{ $page->created_at }}</span></td>
                                    <td><span class="tbody-text">{{ $page->updated_at }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
