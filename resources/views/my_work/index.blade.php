<x-work-layout>
    <x-breadcrumbs :links="['My Woks' => '#']" class="mb-4" />

    <div class="mb-8 text-right">
        <x-link href="{{ route('my-work.create') }}">Add New</x-link>
    </div>

    @forelse ($works as $work)
        <x-work-cart :$work>
            <div class="text-xs text-slate-500">
                @forelse ($work->workApplications as $application)
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <div>{{ $application->user->name }}</div>
                            <div>
                                Applied {{ $application->created_at->diffForHumans() }}
                            </div>
                            <div>
                                Download CV
                            </div>
                        </div>

                        <div>${{ number_format($application->expected_salary) }}</div>
                    </div>
                @empty
                    <div>No applications yet</div>
                @endforelse

                <div class="flex space-x-2">
                    <x-link href="{{ route('my-work.edit', $work) }}">Edit</x-link>

                    <form action="{{ route('my-work.destroy', $work) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Delete</x-button>
                    </form>
                </div>
            </div>
        </x-work-cart>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No jobs yet
            </div>
            <div class="text-center">
                Post your first job <a class="text-indigo-500 hover:underline"
                                       href="{{ route('my-work.create') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-work-layout>
