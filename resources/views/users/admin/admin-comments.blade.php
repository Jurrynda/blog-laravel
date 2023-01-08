<x-layout>
    <nav class="bg-gray-100 md:px-0 px-1">
        <ul class="flex space-x-2 container max-w-md mx-auto py-3 px-2">
            <li class="flex-1">
                <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/admin/users">Users</a>
            </li>
            <li class="flex-1">
                <a class="text-center block rounded hover:border-gray-200 text-orange-600 hover:bg-gray-300 hover:text-white py-2 px-4 font-bold" href="/admin/posts">Posts</a>
            </li>
            <li class="flex-1">
                <a class="text-center block rounded py-2 px-4 bg-orange-600 text-white font-bold" href="/admin/comments">Comments</a>
            </li>
        </ul>
    </nav>
    <div class="overflow-x-auto relative container mx-auto">
        <h1 class="text-4xl text-center my-5">Comments</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Comment text
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Author
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Post
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Created at
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6">
                                {{ $comment->text }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="/users/{{ $comment->user->id }}">
                                    {{ $comment->user->name }}                            
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <a href="/posts/{{ $comment->post->slug }}">
                                    {{ $comment->post->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                {{ $comment->created_at->format('m/d/Y') }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-1">
                                    <a class="text-white bg-green-500 p-1 rounded-lg hover:bg-green-600" href="/comments/{{ $comment->id }}/edit">Edit</a>
                                    <form action="/comments/{{ $comment->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white p-1 rounded-lg hover:bg-red-600" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>
          </table>

    </div>
</x-layout>