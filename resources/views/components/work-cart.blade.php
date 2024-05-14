<x-cart class="mb-4">
    <div class="flex mb-4 justify-between">
        <h2 class="text-lg font-medium">{{$work->title}}</h2>
        <div class="text-slate-500">$ {{number_format($work->salary)}}</div>
    </div>
    <div class="flex mb-4 justify-between text-slate-500 text-sm items-center">
        <div class="flex space-x-4">
            <div>Company name</div>
            <div>{{$work->location}}</div>
        </div>
        <div class="flex space-x-1 text-sm">
            <x-tag>{{ Str::ucfirst($work->experience)}}</x-tag>
            <x-tag>{{$work->category}}</x-tag>
        </div>
    </div>
    <p class="text-sm text-slate-500 mb-4">{!!  nl2br(e($work->description)) !!}</p>
    {{$slot}}
</x-cart>
