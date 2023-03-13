@extends('layouts.app')

@section('title', 'Trang chủ admin')

@section('content')

    {{-- {{dd($data['books'])}} --}}

        {{-- <div class="row">
            <div class="col_single col-sm-6">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col_single col-sm-6">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col_single col-sm-6">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>

            <div class="col_single col-sm-6">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
      
            <div class="col_single col-sm-6">
              <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                  </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
        <div class="insert-btn text-center">
          <a href="{{route('book.create')}}" class="btn btn-success m-2">THÊM SÁCH</a>
        </div>
        
        @if (Session::get('success'))
          <p class="alert alert-success">{{Session::get('success')}}</p>
        @endif
        <table class="table table-bordered">
            <tr>
              <th>STT</th>
              <th>Tên sách</th>
              <th>Mô tả</th>
              <th>Số lượng</th>
              <th>Tác giả</th>
              <th>Nhà xuất bản</th>
              <th>Danh mục</th>
              <th>Nội dung</th>
              <th>Số lượng</th>
              <th width="280px">Action</th>
            </tr>
            @foreach ($books as $book)
            <tr id="row_{{$book->id}}">
              <td>{{ $book->id}}</td>
              <td>{{ $book->ten}}</td>
              <td>{{ $book->mota}}</td>
              <td>{{ $book->soluong}}</td>
              <td>{{ $book->tacgia}}</td>
              <td>{{ $book->nhaxuatban}}</td>
              <td>{{ $book->danhmuc}}</td>
              <td>{{ $book->noidungsach}}</td>
              <td>{{ $book->soluong}}</td>
              <td>
              <form>
              <a class="btn btn-primary" href="{{route('book.edit',$book->id)}}">Sửa</a>
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-delete" data-id = "{{$book->id}}" >Xóa</button>
              </form>
              </td>
            </tr>
            @endforeach
           
          </table/>
          <div class="pagination">
            {{$books->links()}}
        </div>
@endsection

