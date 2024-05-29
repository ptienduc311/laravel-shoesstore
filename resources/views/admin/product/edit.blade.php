@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Chinh sửa sản phẩm</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                {!! Form::open([
                    'route' => ['product.update', $product->id],
                    'method' => 'POST',
                    'files' => true,
                    'id' => 'form-upload-single',
                ]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Tên sản phẩm') !!}
                    {!! Form::text('name', $product->name, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('code', 'Mã sản phẩm') !!}
                    {!! Form::text('code', $product->code, ['id' => 'code', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('initial', 'Giá ban đầu sản phẩm') !!}
                    {!! Form::text('initial', $product->initial, ['id' => 'initial', 'class' => 'form-control']) !!}
                </div>
                @error('initial')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('price', 'Giá bán sản phẩm') !!}
                    {!! Form::text('price', $product->price, ['id' => 'price', 'class' => 'form-control']) !!}
                </div>
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('size', 'Size', ['style' => 'display:block;']) !!}
                    @foreach ($sizes as $id => $name)
                        {!! Form::checkbox('size[]', $id, in_array($id, $key_size), ['style' => 'margin-right: 5px;', 'id' => 'size-' . $id]) !!}
                        {{-- {!! Form::checkbox($name, $value, $checked, [$options]) !!} --}}
                        {!! Form::label('size-' . $id, $name, ['style' => 'display: inline-block; margin-right: 10px;']) !!}
                    @endforeach
                </div>
                @error('size')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('stock_quantity', 'Số lượng') !!}
                    {!! Form::number('stock_quantity', $product->stock_quantity, [
                        'min' => 0,
                        'class' => 'form-control',
                        'style' => 'width:10%;',
                    ]) !!}
                </div>
                @error('stock_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('parameter', 'Thông số của sản phẩm') !!}
                    {!! Form::textarea('parameter', $product->parameter, ['id' => 'parameter', 'class' => 'ckeditor']) !!}
                </div>
                @error('parameter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('detail', 'Chi tiết của sản phẩm') !!}
                    {!! Form::textarea('detail', $product->detail, ['id' => 'detail', 'class' => 'ckeditor']) !!}
                </div>
                @error('detail')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Hình ảnh') !!}
                    <div class="list-img">
                        @foreach ($images as $image)
                        <img width="150" id="image" src="{{asset($image->src)}}" class="img-item">
                    @endforeach
                    </div>
                    {!! Form::file('images[]', [
                        'id' => 'laravel-image-upload',
                        'class' => 'form-control-file',
                        'multiple' => '',
                        'accept' => 'image/*',
                    ]) !!}
                </div>
                @error('images')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Danh mục sản phẩm') !!}
                    {!! Form::select('category_id', $options, $product->category_id, ['class' => 'form-control']) !!}
                </div>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Đánh dấu nổi bật') !!}
                    <div class="form_check">
                        {!! Form::radio('is_featured', '1', $product->is_featured == 1, [
                            'id' => 'yes_featured',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('yes_featured', 'Có', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form_check">
                        {!! Form::radio('is_featured', '2', $product->is_featured == 2, [
                            'id' => 'no_featured',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('no_featured', 'Không', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                @error('is_featured')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Đánh dấu bán chạy') !!}
                    <div class="form_check">
                        {!! Form::radio('is_selling', '1', $product->is_selling == 1, [
                            'id' => 'yes_selling',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('yes_selling', 'Có', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form_check">
                        {!! Form::radio('is_selling', '2', $product->is_selling == 2, [
                            'id' => 'no_selling',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('no_selling', 'Không', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                @error('is_selling')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    {!! Form::label('', 'Trạng thái') !!}
                    <div class="form_check">
                        {!! Form::radio('status', 'active', $product->status == 'active', [
                            'id' => 'active',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('active', 'Công khai', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form_check">
                        {!! Form::radio('status', 'inactive', $product->status == 'inactive', [
                            'id' => 'inactive',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('inactive', 'Không công khai', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form_check">
                        {!! Form::radio('status', 'out_of_stock', $product->status == 'out_of_stock', [
                            'id' => 'out_of_stock',
                            'class' => 'form-check-input',
                        ]) !!}
                        {!! Form::label('out_of_stock', 'Hết hàng', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
