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
























<!-- <x-layout>

    <?php foreach ($posts as $post) : ?>
        <article>
            <a href="/posts/{{ $post->id }}">
                <h1>{{ $post->title }}</h1>
            </a>
            <p>
                By <a href="/authors/{{ $post->user->username }}">{{ $post->user->name }}</a> in <a href="/categories/{{ $post->category->name }}">{{ $post->category->name }}</a>
            </p>

            <div>
                <p>
                    {!! $post->body !!}
                </p>
            </div>
        </article>
    <?php endforeach ?>

</x-layout> -->