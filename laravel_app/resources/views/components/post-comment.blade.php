<section class="lg:grid lg:grid-cols-10">
    <form class="bg-gray-100 border-2 border-double col-span-8 col-start-4 my-10 px-4 rounded-3xl" action="posts/{{ $post }}/comment" method="post">
        <header class="flex">
            <img class="mr-3 my-3 rounded-2xl" src="https://i.pravatar.cc/60" alt="">
            <p class="font-sans my-5 text-blue-500">Leave your comment</p>
        </header>
        <div>
            <textarea class="border-1 form-control form-control-sm h-100 px-2 rounded-3" name="comment" id="" rows="6"></textarea>
            <button class="btn btn-primary my-3 px-2 py-1 rounded-3" type="submit">Post</button>
        </div>
    </form>
</section>