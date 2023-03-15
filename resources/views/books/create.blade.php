@extends('layouts.app')

@section("title", "Thêm sách")

@section('content')
      <form id="insert-form" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="tensach">Tên sách</label>
              <input type="text" class="form-control" name="tensach" id="ten_sach" aria-describedby="ten_sach" placeholder="Nhập tên sách">
            </div>
            <div class="form-group">
              <label for="tensach">Mô tả</label>
              <input type="text" class="form-control" id="mo_ta" name = "mota" aria-describedby="mo_ta" placeholder="Nhập mô tả">
            </div>
            <div class="form-group">
              <label for="soluong">Số lượng</label>
              <input type="number" class="form-control" id="so_luong" name="soluong" aria-describedby="so_luong" placeholder="Nhập số lượng">
            </div>
            <div class="form-group">
              <label for="tacgia">Tác giả</label>
              <input type="text" class="form-control" id="tac_gia" name="tacgia" aria-describedby="tac_gia" placeholder="Nhập tên tác giả">
            </div>
            <div class="form-group">
              <label for="nhaxuatban">Nhà xuất bản</label>
              <input type="text" class="form-control" id="nha_xuat_ban" name="nhaxuatban" aria-describedby="nha_xuat_ban" placeholder="Nhập tên nhà xuất bản">
            </div>
            <div class="form-group">
              <label for="nhaxuatban">Chọn danh mục</label>
              <select name="danhmuc" class="form-control" id= "danh_muc">
                  @foreach ($danhmuc as $item)
                    <option value="{{$item->id}}">{{$item->tendanhmuc}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Chọn hình</label>
                <input type="file" id="image" name="image">
            </div>
            
            <div class="form-group">
                <label for="image">Upload files</label>
                <input type="file" id="files" name="files[]" multiple>
            </div>
            
            <div class="form-group">
              <label for="tensach">Nội dung sách</label>
              <input type="text" class="form-control" id="noi_dung_sach" name="noidungsach" aria-describedby="noi_dung_sach" placeholder="Nhập nội dung sách">
            </div>
            <button type="submit" class="btn btn-primary insert-btn-submit">Submit</button>
          </form> 
@endsection