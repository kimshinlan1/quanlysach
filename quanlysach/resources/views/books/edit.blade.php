@extends('layouts.app')

@section('title', 'Sửa sách')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="book-form" action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tensach">Tên sách</label>
            <input type="text" class="form-control" value="{{ $book->ten }}" name="tensach" id="ten_sach"
                aria-describedby="ten_sach" placeholder="Nhập tên sách">
        </div>
        <div class="form-group">
            <label for="tensach">Mô tả</label>
            <input type="text" class="form-control" value="{{ $book->mota }}" id="mo_ta" name="mota"
                aria-describedby="mo_ta" placeholder="Nhập mô tả">
        </div>
        <div class="form-group">
            <label for="soluong">Số lượng</label>
            <input type="number" class="form-control" value="{{ $book->soluong }}" id="so_luong" name="soluong"
                aria-describedby="so_luong" placeholder="Nhập số lượng">
        </div>
        <div class="form-group">
            <label for="tacgia">Tác giả</label>
            <input type="text" class="form-control" value="{{ $book->tacgia }}" id="tac_gia" name="tacgia"
                aria-describedby="tac_gia" placeholder="Nhập tên tác giả">
        </div>
        <div class="form-group">
            <label for="nhaxuatban">Nhà xuất bản</label>
            <input type="text" class="form-control" value="{{ $book->nhaxuatban }}" id="nha_xuat_ban" name="nhaxuatban"
                aria-describedby="nha_xuat_ban" placeholder="Nhập tên nhà xuất bản">
        </div>
        <div class="form-group">
            <label for="nhaxuatban">Chọn danh mục</label>
            <select name="danhmuc" class="form-control" id="danh_muc">
                @foreach ($categories as $category)
                    <option @if ($category->id == $book->danhmuc) selected @endif value="{{ $category->id }}">
                        {{ $category->tendanhmuc }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Upload hình</label>
            @if (isset($book->files) && count($book->files)>0)
                <img src="{{ asset($book->files[0]->filepath) }}" alt="">
            @endif
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="tensach">Nội dung sách</label>
            <textarea class="form-control" id="summary-ckeditor" name="noidungsach">{{ $book->noidungsach }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('summary-ckeditor');
    </script>
@endsection
