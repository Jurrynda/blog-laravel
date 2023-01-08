<x-layout>


    <form action="/email/verification-notification" method="POST">
        @csrf
        <button type="submit">Send email again</button>
    </form>


</x-layout>