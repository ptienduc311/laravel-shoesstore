@extends('layouts.admin')

@section('title', 'Danh sách slider')
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
                <h3 id="index">Danh sách slider</h3>
                <a href="{{ route('slider.add') }}" title="" id="add-new">Thêm mới</a>
            </div>
        </div>
        <div class="card-end pb-5">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Hình ảnh</span></td>
                                <td><span class="thead-text">Link</span></td>
                                <td><span class="thead-text">Thứ tự</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $temp = 1;
                            ?>

                            @foreach ($sliders as $slider)
                                <tr>
                                    <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="{{ asset($slider::find($slider['id'])->image->src) }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="tb-title fl-left">
                                            @if ($slider['url'] == null)
                                                <a><i id="myLink" style='opacity: 0.5; cursor:pointer;'>Chưa có đường dẫn</i></a>
                                            @else
                                                <a id="myLink" href="{{ $slider['url'] }}"
                                                    title="">{{ $slider['url'] }}</a>
                                            @endif
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li>
                                                <a href="{{ route('slider.edit', $slider['id']) }}" title="Sửa"
                                                    class="edit">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('slider.delete', $slider['id']) }}" title="Xóa"
                                                    class="delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $slider['display_order'] }}</span></td>
                                    <td><span class="tbody-text">{{ $slider['status'] }}</span></td>
                                    <td><span class="tbody-text">{{ $slider['created_by'] }}</span></td>
                                    <td><span class="tbody-text">{{ $slider['created_at'] }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('private-script')
    <script>
        var link = document.getElementById('myLink');
        var maxLength = 30;

        if (link.textContent.length > maxLength) {
            link.textContent = link.textContent.substring(0, maxLength) + '...';
        }
    </script>
@endsection
