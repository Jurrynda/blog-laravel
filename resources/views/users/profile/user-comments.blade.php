  
    <x-layout>
        <div>
            <nav class="bg-gray-100 md:px-0 px-1">
                <ul class="flex space-x-2 container max-w-md mx-auto py-3 px-2">
                    <li class="flex-1">
                        <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{ $user->id }}">Profile</a>
                    </li>
                    <li class="flex-1">
                        <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{$user->id}}/posts">Posts</a>
                    </li>
                    <li class="flex-1">
                        <a class="text-center block rounded py-2 px-4 bg-orange-600 text-white font-bold" href="/users/{{$user->id}}/comments">Comments</a>
                    </li>
                </ul>
            </nav>
            @if (count($user->comment) > 0)
                <ul class="max-w-xl mx-auto">
                    @foreach ($user->comment as $comment)
                        <div class="mb-2">
                            <h3 class="text-lg">
                                Comment added to post - <a class="text-2xl hover:underline hover:text-orange-600" href="/posts/{{ $comment->post->slug }}#comments">{{ $comment->post->title }}</a>
                            </h3>
                        </div>
                        <x-comment-card :comment="$comment" :user="$user" />
                    @endforeach
                </ul>
            @else
                <p class="text-center mt-14">
                    No comments found.
                </p>
            @endif
            
        </div>
    </x-layout>

