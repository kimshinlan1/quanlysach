<x-layout>
    <div class="containter mt-5">
        <div class="text-center text-uppercase fw-bold font-monospace text-info bg-dark pt-3 pb-3">
            <h1>Form Filling</h1>
        </div>
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">

            <form action="/editDevice " method="post" class="align-items-center">
                @csrf
                <div class="mb-3">
                    <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">
                </div>
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
                    <select class="form-select" name="brand_name" aria-label="Default select example">
                        <option disabled hidden selected><?php echo $_GET['brandName'] ?></option>
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
</x-layout>