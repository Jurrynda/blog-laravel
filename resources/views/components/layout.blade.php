<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <title>Laravel - blog</title>
</head>
<body>

    <!-- HEADER -->
    <header class="bg-gray-800 p-5">
        <nav class="flex items-center justify-between container mx-auto">
            <div>
                <a class="text-white text-3xl font-bold tracking-wide" href="/">Blog</a>
            </div>
            
            @guest    
                <div>
                    <a class="font-bold p-3 px-6 pt-2 text-white bg-gray-800 rounded-md baseline hover:bg-gray-700" href="/register">Register</a>
                    <a class="font-bold p-3 px-6 pt-2 text-white bg-orange-600 rounded-md baseline hover:bg-orange-500" href="/login">Login</a>
                </div>
            @endguest
            @auth
                <div 
                class="flex items-center space-x-2 cursor-pointer relative"
                x-data='{open:false}'
                @mouseover="open = true">
                    <div class="text-orange-600 font-bold">
                        {{ auth()->user()->name }}
                    </div>
                    <div>
                        <img 
                        src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/images/anonymous.png') }}" 
                        alt="image" 
                        class="rounded-full h-8 border-2 border-gray-700">
                    </div>
                    <ul
                    class="absolute rounded-md top-10 bg-white right-0 w-36 space-y-3 py-2 px-2 shadow-md z-50" 
                    x-show="open" 
                    @mouseout="open = false">
                        <li class="hover:font-bold hover:text-orange-600">
                            <a class="flex" href="/users/{{ auth()->id() }}">Profile</a>
                        </li>
                        <li class="hover:font-bold hover:text-orange-600">
                            <a class="flex" href="/posts/create">Add new post</a>
                        </li>
                        @if (auth()->user()->is_admin)
                            <li class="hover:font-bold hover:text-orange-600">
                                <a class="flex" href="/admin/users">Administration</a>
                            </li>
                        @endif
                        <li class="hover:font-bold hover:text-orange-600 py-1 border-t-2 border-gray-100">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </nav>
    </header>



    <!-- FLASH MESSAGE -->
    <x-flash-message />

    <!-- CONTENT -->
    <main class="min-h-[calc(100vh-180px)]">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-5 bg-gray-800 text-white mt-10">
        <p>
            All right reserved 2022.
        </p>
    </footer>

</body>
</html>