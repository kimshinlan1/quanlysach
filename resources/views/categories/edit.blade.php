@extends('layouts.app')

@section('title', 'Sửa sách')

@section('content')
    <form action="{{route('category.update', $category->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tensach">Tên danh mục</label>
            <input type="text" class="form-control" value="{{$category->tendanhmuc}}" name="tendanhmuc" id="ten_danhmuc" aria-describedby="ten_sach" placeholder="Nhập tên sách">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection