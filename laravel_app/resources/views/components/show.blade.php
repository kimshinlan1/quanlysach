@props(['comment'])
<section class="lg:grid lg:grid-cols-10">
    <article class="bg-gray-100 border-2 border-double col-span-7 col-start-4 flex my-10 rounded-3xl">
        <div>
            <img class="mx-2 my-2 rounded-2xl" src="https://i.pravatar.cc/400" alt="">
        </div>
        <div class="mx-5">
            <header>
                <h3 class="font-bold">Title</h3>
                <p class="text-xs">
                    Posted <time>{{ $comment->created_at->diffForHumans() }}</time>
                </p>
            </header>
            <p class="bg-info px-4 py-3 my-5 rounded-xl text-blue-100">
                {{ $comment->body }}
            </p>
        </div>
    </article>
</section>