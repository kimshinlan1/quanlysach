@extends('layouts.app')

@section('title', 'Sửa sách')

@section('content')
    {{-- {{dd($danhmuc)}} --}}
    <form class="book-form" action="{{route('book.update', $book->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tensach">Tên sách</label>
            <input type="text" class="form-control" value="{{$book->ten}}" name="tensach" id="ten_sach" aria-describedby="ten_sach" placeholder="Nhập tên sách">
          </div>
          <div class="form-group">
            <label for="tensach">Mô tả</label>
            <input type="text" class="form-control" value="{{$book->mota}}" id="mo_ta" name = "mota" aria-describedby="mo_ta" placeholder="Nhập mô tả">
          </div>
          <div class="form-group">
            <label for="soluong">Số lượng</label>
            <input type="number" class="form-control" value="{{$book->soluong}}" id="so_luong" name="soluong" aria-describedby="so_luong" placeholder="Nhập số lượng">
          </div>
          <div class="form-group">
            <label for="tacgia">Tác giả</label>
            <input type="text" class="form-control" value="{{$book->tacgia}}" id="tac_gia" name="tacgia" aria-describedby="tac_gia" placeholder="Nhập tên tác giả">
          </div>
          <div class="form-group">
            <label for="nhaxuatban">Nhà xuất bản</label>
            <input type="text" class="form-control" value="{{$book->nhaxuatban}}" id="nha_xuat_ban" name="nhaxuatban" aria-describedby="nha_xuat_ban" placeholder="Nhập tên nhà xuất bản">
          </div>
          <div class="form-group">
            <label for="nhaxuatban">Chọn danh mục</label>
            <select name="danhmuc" class="form-control" id= "danh_muc">
                @foreach ($categories as $category)
                  <option @if($category->id == $book->danhmuc) selected @endif  value="{{$category->id}}">{{$category->tendanhmuc}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label for="image">Upload hình</label>
            @if($book->hinh) <img src="{{asset('/uploads/images/' . $book->hinh)}}" alt="">@endif
            <input type="file" name="image">
          </div>
          <div class="form-group">
            <label for="tensach">Nội dung sách</label>
            <input type="text" class="form-control" value="{{$book->noidungsach}}" id="noi_dung_sach" name="noidungsach" aria-describedby="noi_dung_sach" placeholder="Nhập nội dung sách">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection