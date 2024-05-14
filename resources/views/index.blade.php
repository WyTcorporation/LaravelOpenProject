<x-layout>
    <x-slot:styles>
    </x-slot:styles>
    <x-slot:title>Tasks</x-slot:title>
    @if(count($tasks))
        <div class="text-xl">
            There are tasks!
        </div>
        <nav class="mt-4 mb-4">
            <a class="link" href="{{route('tasks.create')}}">Create Task!</a>
        </nav>
        @foreach ($tasks as $task)
            <p>
                <a @class(['line-through'=> $task->completed]) href="{{route('tasks.show',['task'=>$task])}}">{{ $task->title }}</a>
            </p>
        @endforeach
    @else
        <div class="text-2xl">
            There are no tasks!
        </div>
    @endif

    @if($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
</x-layout>
