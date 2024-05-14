<x-work-layout>
    <x-breadcrumbs
        :links="['Work' => route('work.index'), $work->title => '#']"
        class="mb-4"
    />
    <x-work-cart :work="$work">
        <p class="mb-4 text-sm text-slate-500">
            {!! nl2br(e($work->description)) !!}
        </p>

        @can('apply', $work)
            <x-link :href="route('work-application.create', ['work'=> $work ])">
                Apply
            </x-link>
        @else
            <div class="text-center text-sm font-medium text-slate-500">
                You already applied to this job
            </div>
        @endcan
    </x-work-cart>
</x-work-layout>
