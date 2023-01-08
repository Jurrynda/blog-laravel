@props(['post'])
@php
    $tags = explode(',', $post->tags);
@endphp
<li class="p-5 md:flex-row flex-col shadow-xl rounded-md border border-gray-200">
    <div>
        @can('doAnything', $post)    
        <div>
            <div class="flex space-x-1 justify-end py-2">
                <a class="hover:underline" href="/posts/{{ $post->slug }}/edit">edit</a>
                <form action="/posts/{{ $post->slug }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="hover:underline" type="submit">delete</button>
                </form>
            </div>
        </div>
    @endcan
    </div>
    <div class="flex space-x-2">
        <a href="/posts/{{ $post->slug }}" class="w-full">
            <img 
                class="object-cover h-48 w-full"
                src="{{ $post->image ? asset('storage/' . $post->image) : asset('/images/img.jpg')}}" alt=""
            />
        </a>

        <div class="flex flex-col justify-between w-full">
            <a href="/posts/{{ $post->slug }}" class="hover:underline text-gray-800 font-bold text-2xl">
                {{ $post->title }}
            </a>
            <div >
                <a href="users/{{ $post->user->id }}" class=" text-orange-500 hover:underline">
                    {{ $post->user->name }}
                </a>
            </div>
            <div>
                <div>
                    <div class="text-gray-800">
                        {{ str_limit($post->text, 80) }}
                    </div>
                </div>
            </div>
            <div class="flex justify-between">
                <date datetime="{{ $post->created_at->toW3cString() }}" class="text-gray-400">
                    {{ $post->created_at->diffForHumans()}}
                </date>
                <a href="/posts/{{ $post->slug }}#comments" class="text-gray-400 hover:underline">
                    {{ $post->comment->count() }} 
                    {{ str_plural('comment', count($post->comment))}}
                </a>
            </div>
        </div>
    </div>
</li>

