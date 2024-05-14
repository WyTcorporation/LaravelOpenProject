<x-layout>
    @push('styles')@endpush
    @push('scripts')@endpush
    <x-slot:title>
        Task : {{$task->title}}
    </x-slot:title>
    <div class="mb-4">
        <h1 class="text-3xl font-bold underline">{{$task->title}}</h1>
    </div>
    <div class="mb-4">
        <a class="link" href="{{route('tasks.index')}}">Tasks</a>
    </div>
    @if($task->description)
        <p class="mb-4 text-slate-700">{{$task->description}}</p>
    @endif
    @if($task->long_description)
        <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
    @endif

    <p class="mb-4">
        @if($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not completed</span>
        @endif
    </p>

    <p class="mb-4 text-sm text-slate-500">Created {{$task->created_at->diffForHumans()}} *
        Updated {{$task->updated_at->diffForHumans()}}</p>

    <div class="flex gap-2">
        <a class="btn"
           href="{{route('tasks.edit',['task'=>$task])}}">Edit</a>


        <form action="{{route('tasks.toggle-complete',['task'=>$task])}}" method="post">
            @csrf
            @method('PUT')
            <button class="btn-tasks" type="submit">
                Mark as {{ $task->completed ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form action="{{route('tasks.destroy',['task'=>$task])}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn-tasks" type="submit">Remove Task</button>
        </form>

    </div>
</x-layout>


