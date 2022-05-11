<x-layout>
    <div class="container mt-5">
        <div class="text-center text-uppercase fw-bold font-monospace text-info bg-dark pt-3 pb-3">
            <h1>Form Filling</h1>
        </div>
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">

            <form action="/devices " method="post" class="align-items-center">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Device Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="brandName" class="form-label">Brand</label>
                    <select class="form-select" name="brand_id" aria-label="Default select example">
                        <option disabled hidden selected>Choose device's brand</option>
                        @foreach($brands as $brand)
                        <option value={{ $brand->id }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </main>
        <div class="text-info text-center">
            <h2>List of Devices</h2>
        </div>
        <div>
            @if($devices->count() < 1) <p class="text-center ">There is no device to display</p>

                @else
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-secondary">
                            <th data-width="100" scope="col">Device Name</th>
                            <th data-width="800" scope="col">Brand</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devices as $device)
                        <tr class="table-secondary">
                            <td data-width="100">{{ $device->name }}</td>
                            <td data-width="800">{{ $device->brand->name }}</td>
                            <td>
                                <form action="/editDevice" method="get">
                                    <input type="hidden" value={{ $device->id }} name="id">
                                    <input type="hidden" value={{ $device->brand->name }} name="brandName">
                                    <button class="btn btn-primary me-1">Edit</button>
                                </form>
                                </button>
                            </td>
                            <td>
                                <form action="/deteleDevice" method="get">
                                    <input type="hidden" value={{ $device->id }} name="delete-id">
                                    <button class="btn btn-primary me-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="myModal" role="dialog">
                    @include('dialog._editForm',['device' => $device])
                </div>

                @endif

        </div>
    </div>
</x-layout>