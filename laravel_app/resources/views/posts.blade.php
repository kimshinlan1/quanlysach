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
        <hr class="bg-danger border-2 border-top border-danger mt-5">
        <section class="lg:grid lg:grid-cols-10">
            <article class="bg-gray-100 border-2 border-double col-span-5 col-start-4 flex my-10 rounded-3xl">
                <form action="" method="post">
                    <header class="flex">
                        <img src="https://i.pravatar.cc/60" alt="">
                        <p>Leave your comment</p>
                    </header>
                    <div>
                        <textarea class="border-1 h-100 mx-3 my-4 rounded-3 w-100" name="comment" id=""></textarea>
                    </div>
                </form>

            </article>
        </section>

        <x-show></x-show>
    </main>
</x-layout>