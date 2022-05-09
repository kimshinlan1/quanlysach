<x-layout>
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
        <h1 class="text-center">Register</h1>
        
        <form action="/register" method="post" class="align-items-center">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                @error('username')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <p class="text-red-500" text-xs mt-1>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </main>

</x-layout>