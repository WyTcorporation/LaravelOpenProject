<x-layout>
    @push('styles')@endpush
    @push('scripts')@endpush
    <x-slot:title>
        Task : Create new Task
    </x-slot:title>
    <h1 class="text-3xl font-bold underline">Create new Task</h1>
    @include('form')
</x-layout>


