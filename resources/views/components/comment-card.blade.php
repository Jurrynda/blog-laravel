@props(['comment', 'user'])

<li class="border-l-2 border-gray-800 mb-12 pl-3">
    <div>
        <a href="#">
            {{ $user->name}}
        </a>
        <div class="flex justify-between">
            <div class="text-gray-400">
                {{ $comment->created_at->diffForHumans()}}
            </div>
            @can('doAnything', $comment)    
                <div class="flex space-x-2">
                    <a class="hover:underline" href="/comments/{{ $comment->id }}/edit">Edit</a>
                    <form action="/comments/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="hover:underline" type="submit">Delete</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
    <hr class="my-1">
    <p>
        {{ $comment->text }}
    </p>
</li>