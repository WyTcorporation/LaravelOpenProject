<x-work-layout>
    <x-breadcrumbs
        :links="['Work' => route('work.index')]"
        class="mb-4"
    />
    <x-cart class="mb-4 text-sm" x-data="">
        <form x-ref="filters" id="filtering-form" action="{{ route('work.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}"
                                  placeholder="Search for any text" form-ref="filters" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>

                    <div class="flex space-x-2">
                        <x-text-input type="text" name="min_salary" value="{{ request('min_salary') }}"
                                      placeholder="From" form-ref="filters" />
                        <x-text-input type="text" name="max_salary" value="{{ request('max_salary') }}"
                                      placeholder="To" form-ref="filters" />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>

                    <x-radio-group name="experience"
                                   :options="array_combine(
                array_map('ucfirst', \App\Models\Work::$experience),
                \App\Models\Work::$experience,
            )" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>

                    <x-radio-group name="category"
                                   :options="\App\Models\Work::$category" />
                </div>
            </div>

            <x-button class="w-full">Filter</x-button>
        </form>
    </x-cart>
    @forelse($works as $work)
          <x-work-cart :work="$work">
              <div class="">
                  <x-link :href="route('work.show',['work'=>$work])" >
                      Show
                  </x-link>
              </div>
          </x-work-cart>
    @empty
        <h2>No data</h2>
    @endforelse
</x-work-layout>
