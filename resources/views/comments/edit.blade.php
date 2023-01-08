<x-layout>
    <div>

        @can('doAnything', $comment)
            <form action="/comments/{{ $comment->id }}" method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <label for="text">Text</label>
                    <textarea name="text" cols="30" rows="10">{{ $comment->text }}</textarea>
                </div>
                <button type="submit">Edit</button>
            </form>
        @endcan

        @cannot('doAnything', $comment)
            <p>
                U are not able to edit this comment. 
                <a href="{{ url()->previous() }}" class="text-orange-600">Go back</a>
            </p>
        @endcannot
        
    </div>
</x-layout>
