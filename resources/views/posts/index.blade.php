<x-layout>
    
     <!-- SEARCH FORM  -->
     @include('partials._search')

    <div class= "container mx-auto md:px-0 px-1">
        <ul class="grid grid-cols-1 gap-14 2xl:grid-cols-2 mb-10">
            @foreach ($posts as $post)
                <x-post-card :post="$post"/>
            @endforeach
        </ul>

        {{ $posts->links() }}
        
    </div>
    
</x-layout>