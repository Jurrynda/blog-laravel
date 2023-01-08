<x-layout>
    <div class="container mx-auto flex justify-center pt-24">
        <div>
            <h1 class="text-4xl mb-5 text-center">Add new post</h1>
            <form method="POST" action="/posts" enctype="multipart/form-data" class="space-y-4 w-96">
                @csrf

                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" class="w-full bg-gray-100 block appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('title')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" class="block">
                    @error('image')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="text">Text</label>
                    <textarea rows="6" name="text" class="w-full bg-gray-100 block appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500"></textarea>
                    @error('text')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="tags">Tags(comma separeted)</label>
                    <input type="text" name="tags" class="w-full bg-gray-100 block appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('tags')
                        <p>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="bg-orange-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>