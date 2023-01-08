

<x-layout>
    <nav class="bg-gray-100 md:px-0 px-1">
        <ul class="flex space-x-2 container max-w-md mx-auto py-3 px-2">
            <li class="flex-1">
                <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{ $user->id }}">Profile</a>
            </li>
            <li class="flex-1">
                <a class="text-center block rounded py-2 px-4 bg-orange-600 text-white font-bold" href="/users/{{$user->id}}/posts">Posts</a>
            </li>
            <li class="flex-1">
                <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{$user->id}}/comments">Comments</a>
            </li>
        </ul>
    </nav>
    <div class= "container mx-auto md:px-0 px-1">
        @if (count($user->post) > 0)
            <ul class="grid grid-cols-1 gap-14 2xl:grid-cols-2 mb-10">
                @foreach ($user->post as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </ul>
        @else
            <p class="text-center mt-14">
                No posts found.
                <a href="/posts/create" class="text-orange-600 underline">
                    Add a new post.
                </a>
            </p>
        @endif
        
    </div>
</x-layout>