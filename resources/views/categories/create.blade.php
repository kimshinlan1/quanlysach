@extends('layouts.app')

@section("title", "Thêm danh mục")

@section('content')
      <form action="{{route('category.store')}}" id="category-insert-form" method="POST">
        @csrf
            <div class="form-group">
              <label for="tensach">Tên danh mục</label>
              <input type="text" class="form-control" name="tendanhmuc" id="ten_danhmuc" aria-describedby="ten_sach" placeholder="Nhập tên sách">
            </div>
            <button type="submit" class="btn btn-primary insert-btn-submit">Thêm</button>
        </form> 
@endsection