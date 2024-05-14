<x-layout>
    @push('styles')@endpush
    @push('scripts')@endpush
    <x-slot:title>
        Task : {{$task->title}}
    </x-slot:title>
    <h1 class="text-3xl font-bold underline">Edit Task: {{$task->title}}</h1>

    @include('form',['task'=>$task])
</x-layout>


