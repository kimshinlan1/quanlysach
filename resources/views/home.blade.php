@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    {{-- <a class="navbar-brand" href="/">Trang chủ</a> --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">

        <li class="nav-item active">
            <a class="navbar-brand" href="/">Trang chủ</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('book.index')}}">Sách <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('category.index')}}">Danh mục sách</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tác giả</a>
        </li>
      </ul>
    </div>
    <div class="form-search">
        <form class="form-inline my-2 my-lg-0 " id = "search-frm" method="GET">
            @csrf
            <input type="text" class="form-control" name="search" id="search-input" placeholder="Tìm kiếm...">
      </form>
      <div id="search-result">
        <ul class="search-results-table">
            <li>1</li>
            <li>2</li>
            <li>3</li>
        </ul>
      </div>
    </div>
  </nav>
@endsection