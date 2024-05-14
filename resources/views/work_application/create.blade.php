<x-work-layout>
    <x-breadcrumbs  :links="[
        'Works' => route('work.index'),
        $work->title => route('work.show',['work'=>$work]),
        'Apply' => '#',
    ]"
                   class="mb-4"
    />

    <x-work-cart :$work />

    <x-cart>
        <h2 class="mb-4 text-lg font-medium">
            Your Job Application
        </h2>

        <form action="{{ route('work-application.store', $work) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary" :required="true">Expected Salary</x-label>
                <x-text-input type="number" name="expected_salary" />
            </div>

            <div class="mb-4">
                <x-label for="cv" :required="true">Upload CV</x-label>
                <x-text-input type="file" name="cv" />
            </div>

            <x-button class="w-full">Apply</x-button>
        </form>
    </x-cart>
</x-work-layout>
