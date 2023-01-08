@if (session()->has('message'))
    <div 
        class="bg-red-500 text-white font-bold text-center py-2" 
        x-data="{show:true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show">
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif