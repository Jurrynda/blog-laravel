<x-layout>
    <div class="container mx-auto flex justify-center pt-28">
        <div>
            <h1 class="text-4xl mb-5 text-center">Login</h1>
            <form action="/authenticate" method="POST" class="space-y-4 w-96">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-800 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="text" name="email" value="{{ old('email') }}">
                    @error('name')
                        <p class="bg-red-500 text-white">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label for="password">Password</label>
                    <input class="bg-gray-100 block w-full appearance-none border-2 border-gray-200 rounded py-1 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-orange-500" type="password" name="password">
                    @error('name')
                        <p class="bg-red-500 text-white">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="text-center">
                    <button class="bg-orange-600 rounded-md py-1 px-2 text-white font-bold hover:bg-orange-500" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>