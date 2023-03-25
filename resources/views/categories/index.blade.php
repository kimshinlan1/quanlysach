@extends('layouts.app')

@section('title', 'Danh mục sách')

@section('content')
    <div class="insert-btn text-center">
        <a href="{{ route('category.create') }}" class="btn btn-success m-2">THÊM DANH MỤC</a>
    </div>
    @if (Session::get('delete_success'))
        <p class="alert alert-success">{{ Session::get('delete_success') }}</p>
    @elseif (Session::get('insert_cate_success'))
        <p class="alert alert-success">{{ Session::get('insert_cate_success') }}</p>
    @elseif (Session::get('cate_success_update'))
        <p class="alert alert-success">{{ Session::get('cate_success_update') }}</p>
    @endif
    @foreach ($categoryWithbooks as $cate)
        <div class="danhmuc-item">
            <div class="danhmuc h2 text-secondary text-bold d-flex justify-content-between">
                <div class="tendanhmuc">
                    {{ $cate['tendanhmuc'] }}
                </div>

                <div class="tools">
                    <form method="POST" action="{{ route('category.destroy', $cate['id']) }}">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-primary" href="{{ route('category.edit', $cate['id']) }}">Sửa</a>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>

            </div>
            <div class="sach">
                <div class="row row-cols-3">
                    @foreach ($cate['books'] as $book)
                        <div class="card" style="width: 18rem;">

                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $book['ten'] }}</h5>
                                @if ($book['hinh'])
                                    <img class="card-img-top" src="{{ asset('uploads/images/' . $book['hinh']) }}"
                                        alt="Hình cuốn sách">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection
