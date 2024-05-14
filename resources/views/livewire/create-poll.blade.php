<div>
    <form wire:submit.prevent="createPoll">
        <div class="mb-4 mt-4">
            <label>Poll title</label>
            <input type="text" wire:model.live="title" />
            <div class="text-red-500">@error('title') {{ $message }} @enderror</div>
        </div>

        <div class="mb-4 mt-4">
            <button class="btn" wire:click.prevent="addOption">Add Option</button>
        </div>
        <div class="mt-4">
            @foreach($options as $index=>$option)
                <div class="mb-4">
                    <label>Option {{$index+1}}</label>
                </div>
                <div class="flex gap-2">
                    <input type="text" wire:model.live="options.{{$index}}"/>
                    <button class="btn" wire:click.prevent="removeOption({{$index}})">Remove</button>
                </div>
                <div class="text-red-500">@error('options.*') {{ $message }} @enderror</div>
            @endforeach
        </div>

        <button class="btn mb-4 mt-4" type="submit">Create Poll</button>
    </form>
</div>
