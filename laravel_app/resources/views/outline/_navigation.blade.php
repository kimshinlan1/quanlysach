<nav class="md:flex md:justify-between md:items-center">
    <div>
        <a href="/">
            <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
        </a>
    </div>

    <div class="mt-8 md:mt-0">
        @guest
        <a href="/devices" class="bg-gray-200 font-bold ml-4 mr-4 px-5 py-3 rounded-3xl text-xs text-red-400 uppercase">Device list</a>
        <a href="/login" class="bg-gray-200 font-bold ml-4 mr-4 px-5 py-3 rounded-3xl text-xs text-red-400 uppercase">Log in</a>
        <a href="/register" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
            Register
        </a>
        @else
        <a href="/logout" class="bg-gray-200 font-bold ml-4 mr-4 px-5 py-3 rounded-3xl text-xs text-red-400 uppercase">Log out</a>
        @endguest
    </div>
</nav>