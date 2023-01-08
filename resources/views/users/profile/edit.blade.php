<x-layout>

    <div>
        <nav class="bg-gray-100 md:px-0 px-1">
            <ul class="flex space-x-2 container max-w-md mx-auto py-3 px-2">
                <li class="flex-1">
                    <a class="text-center block rounded py-2 px-4 bg-orange-600 text-white font-bold" href="/users/{{ $user->id }}">Profile</a>
                </li>
                <li class="flex-1">
                    <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{$user->id}}/posts">Posts</a>
                </li>
                <li class="flex-1">
                    <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/users/{{$user->id}}/comments">Comments</a>
                </li>
            </ul>
        </nav>
        <div class="container mx-auto flex justify-center pt-28">
            <div>
                <h1 class="text-4xl text-center mb-6">Edit profile</h1>
                <form enctype="multipart/form-data" action="/users/{{ $user->id }}" method="POST" class="space-y-4 w-96">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="name">Name</label>
                        <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="text" name="name" value="{{ $user->name }}">
                        @error('name')
                            <p class="bg-red-500 text-white">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="text" name="email" value="{{ $user->email }}">
                        @error('email')
                            <p class="bg-red-500 text-white">
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
                        <img class="w-full" src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/images/img.jpg') }}">
                    </div>

                    <div>
                        <label for="old_password">Old password</label>
                        <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="password" name="old_password">
                        @error('old_password')
                            <p class="bg-red-500 text-white">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password">New password</label>
                        <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="password" name="password">
                        @error('password')
                            <p class="bg-red-500 text-white">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="bg-orange-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Update</button>
                    </div>
                </form>
                <form class="text-center mt-2" action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Delete</button>
                </form>
            </div>
        </div>
        
    </div>
    
</x-layout>