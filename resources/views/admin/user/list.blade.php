@extends('layouts.admin')

@section('title', 'Danh sách thành viên')
@section('custom-css')
    <link href="{{ asset('admin_style/css/user/list_user.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div id="content" class="fl-right">
        @if (session('status'))
            <div class="alert alert-success">
                {!! session('status') !!}
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger">
                {!! session('danger') !!}
            </div>
        @endif
        <div id="card">
            <div class="card-header">
                <h2>DANH SÁCH THÀNH VIÊN</h2>
                <div class="controls">
                    <form action="#">
                        @php
                            if (!request()->input('status')) {
                                $status = 'active';
                            } else {
                                $status = request()->input('status');
                            }
                        @endphp
                        <input type="text" name="keyword" value="{{ request()->input('keyword') }}"
                            placeholder="Tìm kiếm" id="keywordInput" />
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" value="user" id="urlLoad">
                        <button class="search-btn">Tìm kiếm</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích hoạt<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <span class="seperate">|</span>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu hóa<span
                            class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <div>
                    <button class="reset-btn" id="resetBtn">Mặc định</button>
                </div>
            </div>
            <div class="card-end">
                <form action="{{ route('user.action') }}">
                    @csrf
                    <div class="select-option">
                        <select name="act">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
                        </select>
                        <button class="btn-apply">Áp dụng</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th>#</th>
                                <th>Tên tài khoản</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Ngày tạo</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->total() > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td><input type="checkbox" name="list_check[]" value="{{ $user->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge {{ $role->name }}">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn edit" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            @if (Auth::id() != $user->id)
                                                <a href="{{ route('user.delete', $user->id) }}"
                                                    onclick="return confirm('Bạn có chắc chắn xóa bản ghi này?')"
                                                    class="btn delete" type="button" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="nullResult">Không tìm thấy bản ghi</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
            </div>

            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection
