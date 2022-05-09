<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="containter mt-5">
                <div class="text-center text-uppercase fw-bold font-monospace text-info bg-dark pt-3 pb-3">
                    <h1>Form Filling</h1>
                </div>
                <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">

                    <form action="/editDevice " method="post" class="align-items-center">

                        <div class="mb-3">
                            <input type="hidden" value={{ $device->id }} name="id" id="deviceID">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Device Name</label>
                            <input type="text" class="form-control" id="deviceName" name="name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-red-500" text-xs mt-1>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brandName" class="form-label">Brand</label>
                            <select class="form-select" name="brand_name" aria-label="Default select example">
                                <option disabled hidden selected id="brandName">{{ $device->brand->name }}</option>
                            </select>
                            @error('brand_name')
                            <p class="text-red-500" text-xs mt-1>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </main>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>