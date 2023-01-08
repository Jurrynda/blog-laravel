<x-layout>

    @can('doAnything', $post)
    <div class="container mx-auto flex justify-center pt-16">
        <div>
            <h1 class="text-4xl text-center">Edit post</h1>
            <form enctype="multipart/form-data" method="POST" action="/posts/{{ $post->slug }}" class="space-y-4 w-96">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('title')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" >
                    @error('image')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <img class="w-full" src="{{$post->image ? asset('storage/' . $post->image) : asset('/images/img.jpg')}}" alt="">
                </div>
                <div>
                    <label for="text">Text</label>
                    <textarea name="text" cols="30" rows="10" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">{{ $post->text }}</textarea>
                    @error('text')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="tags">Tags(comma separeted)</label>
                    <input type="text" name="tags" value="{{ $post->tags }}" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('tags')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="bg-orange-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>
    @endcan

    @cannot('doAnything', $post)
        <p>
            U are not able to edit this post. 
            <a href="{{ url()->previous() }}" class="text-orange-600">Go back</a>
        </p>
    @endcannot

</x-layout>