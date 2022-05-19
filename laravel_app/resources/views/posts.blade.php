<x-layout>
    <x-header :categories="$categories"></x-header>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
        <x-first-post-card :post="$posts[0]" />

        @if($posts->count() > 1)
        <div class="lg:grid lg:grid-cols-6">
            @foreach($posts->skip(1) as $post)
            <x-post-card :post="$post" class="bg-blue-500 {{ $loop->iteration < 5 ? 'col-span-3' : 'col-span-2' }}" />
            @endforeach
        </div>
        @endif
        @else
        <p class="text-center">No posts yet. Please check back</p>
        @endif
        
    </main>
</x-layout>