<x-layout>
    <section class="container mx-auto">
        <div class="mx-auto shadow-xl rounded-md border border-gray-200">
            <div class="max-w-4xl flex p-1 space-x-2 flex-col mx-auto my-5">
                <div>
                    <div class="text-gray-800 font-bold text-5xl">
                        {{ $post->title }}
                    </div>
                    <div class="my-5 flex justify-between">
                        <div class="flex flex-col">
                            <a href="users/{{ $post->user->id }}" class="text-orange-500 hover:underline">
                                {{ $post->user->name }}
                            </a>
                            <date datetime="{{ $post->created_at->toW3cString() }}" class="text-gray-400">
                                {{ $post->created_at->diffForHumans() }}
                            </date>
                        </div>
                        <div class="flex items-end flex-col">
                            @can('doAnything', $post)    
                                <div>
                                    <div class="flex space-x-1">
                                        <a class="hover:underline" href="/posts/{{ $post->slug }}/edit">edit</a>
                                        <form action="/posts/{{ $post->slug }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="hover:underline" type="submit">delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                            <a href="/posts/{{ $post->slug }}#comments" class="text-gray-400 hover:underline">
                                {{ $post->comment->count() }} 
                                {{ str_plural('comment', count($post->comment))}}
                            </a>
                        </div>
                    </div>
                    <div>
                        <img 
                            class="object-fill"
                            src="{{$post->image ? asset('storage/' . $post->image) : asset('/images/img.jpg')}}" alt=""
                        />
                    </div>
                    
                    <div class="my-6">
                        <div class="text-gray-800">
                            {{ $post->text }}
                        </div>
                    </div>
                    <div class="space-x-4">
                        @foreach (explode(',', $post->tags) as $tag)
                            <a href="#" class="text-orange-500 underline">
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="comments" class="container mx-auto shadow-xl rounded-md border border-gray-200 mt-10 p-6">
        <div>
            <h1 class="text-4xl text-center mb-8">Comments</h1>
            @auth
                <form class="max-w-xl mx-auto" action="/comments" method="POST">
                    @csrf

                    <div>
                        <label for="text" class="block mb-2">Add comment</label>
                        <textarea name="text" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Write your thoughts here..."></textarea>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="flex justify-end">
                        <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded mt-2">
                            Add
                        </button>
                    </div>
                </form>    
                <hr class="max-w-xl mx-auto my-10">
            @endauth
            @guest
                <div class="text-center mb-10">
                    <p>
                        U need to be sign-in to add a comment. <a class="text-orange-600 hover:underline" href="{{ route('login') }}">Sign-in</a>
                    </p>
                </div>
            @endguest
            <div>
                <ul class="max-w-xl mx-auto">
                    @foreach ($post->comment as $comment)
                        <x-comment-card :comment="$comment" :user="$comment->user" />
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
</x-layout>