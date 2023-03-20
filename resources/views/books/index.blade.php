@extends('layouts.app')

@section('title', 'Trang chủ admin')

@section('content')

    {{-- {{dd($data['books'])}} --}}
    <div class="tool_buttons d-flex justify-content-between">
        <div class="insert-btn text-center">
            <a href="#" class="btn btn-primary m-2" data-toggle="modal" data-target="#uploadModal">Import CSV</a>
        </div>

        <div class="insert-btn text-center">

            <a href="{{ route('export') }}" class="btn btn-secondary m-2">Export CSV</a>
        </div>

        <div class="insert-btn text-center">
            <a href="{{ route('book.create') }}" class="btn btn-success m-2">Insert Book</a>
        </div>
    </div>

    @if (Session::get('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif
    <table id="table-data" class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="align-middle text-center" scope="col">STT</th>
                <th class="align-middle text-center" scope="col">Tên sách</th>
                <th class="align-middle text-center" scope="col">Mô tả</th>
                <th class="align-middle text-center" scope="col">Số lượng</th>
                <th class="align-middle text-center" scope="col">Tác giả</th>
                <th class="align-middle text-center" scope="col">Nhà xuất bản</th>
                <th class="align-middle text-center" scope="col">Danh mục</th>
                <th class="align-middle text-center" scope="col">Hình</th>
                <th class="align-middle text-center" scope="col">Nội dung</th>
                <th class="align-middle text-center" scope="col" width="280px">Thao tác</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr id="row_{{ $book->id }}">
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->ten }}</td>
                        <td>{{ $book->mota }}</td>
                        <td>{{ $book->soluong }}</td>
                        <td>{{ $book->tacgia }}</td>
                        <td>{{ $book->nhaxuatban }}</td>
                        <td>
                            @if ($book->category)
                                {{ $book->category->tendanhmuc }}
                            @endif
                        </td>
                        <td>
                            @if ($book->hinh)
                                <img src="{{ asset('/uploads/images/' . $book->hinh) }}" alt="Hình">
                            @endif
                        </td>
                        <td>{{ $book->noidungsach }}</td>
                        <td>
                            <form>
                                <a class="btn btn-primary" href="{{ route('book.edit', $book->id) }}">Sửa</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete"
                                    data-id="{{ $book->id }}">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>

    <div class="pagination">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="upload-csv-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload CSV file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="csv_file">Select a CSV file:</label>
                            <input type="file" class="form-control-file" id="csv_file" name="csv_file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
