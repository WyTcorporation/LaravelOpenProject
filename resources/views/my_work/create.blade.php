<x-work-layout>
    <x-breadcrumbs :links="['My Works' => route('my-work.index'), 'Create' => '#']" class="mb-4" />

    <x-cart class="mb-8">
        <form action="{{ route('my-work.store') }}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Work Title</x-label>
                    <x-text-input type="text" name="title" />
                </div>

                <div>
                    <x-label for="location" :required="true">Location</x-label>
                    <x-text-input type="text" name="location" />
                </div>

                <div class="col-span-2">
                    <x-label for="salary" :required="true">Salary</x-label>
                    <x-text-input  name="salary" type="number" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" type="textarea" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group name="experience" :value="old('experience')"
                                   :all-option="false"
                                   :options="array_combine(
                array_map('ucfirst', \App\Models\Work::$experience),
                \App\Models\Work::$experience,
            )" />
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group name="category" :all-option="false" :value="old('category')"
                                   :options="\App\Models\Work::$category" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Create Job</x-button>
                </div>
            </div>
        </form>
    </x-cart>
</x-work-layout>
