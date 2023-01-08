<x-layout>
<div class="container mx-auto flex justify-center pt-16">
        <div>
            <h1 class="text-4xl text-center">Register</h1>
            <form action="/users/create" method="POST" enctype="multipart/form-data" class="space-y-4 w-96">
                @csrf

                <div>
                    <label for="name">Name(required)</label>
                    <input type="text" name="name" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('name')
                        <p class="bg-red-500 text-white">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email">Email (required)</label>
                    <input type="text" name="email" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('email')
                        <p class="bg-red-500 text-white">
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
                    <label for="password">Password (required)</label>
                    <input type="password" name="password" class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('password')
                        <p class="bg-red-500 text-white">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirm password (required)</label>
                    <input type="password" name="password_confirmation"class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500">
                    @error('password_confirmation')
                        <p class="bg-red-500 text-white">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="bg-orange-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Register</button>
                </div>
                <div>
                    Already have an acount ? 
                    <a href="/login" class="text-orange-600 underline">
                        Sign-In
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>