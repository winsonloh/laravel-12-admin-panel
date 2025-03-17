@props(['options' => [], 'selected' => null])

<div x-data="dropdown()" class="relative w-full">
    <!-- Display Selected Value -->
    <div class="border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm p-2 cursor-pointer bg-white flex items-center justify-between"
         @click="open = !open">
        <span x-text="selectedLabel() || '{{ __('global.select') }}'" class="text-gray-700"></span>
        <span class="text-gray-500">&#9662;</span> <!-- Dropdown arrow -->
    </div>

    <!-- Dropdown Menu -->
    <div x-show="open"
         @click.away="open = false"
         class="absolute z-50 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg p-2">
        
        <!-- Options List -->
        <template x-for="(key, index) in Object.keys(options)" :key="index">
            <div @click="selectItem(key)" class="p-2 hover:bg-gray-100 rounded-md cursor-pointer">
                <span x-text="options[key]" class="text-gray-700"></span> <!-- Properly display label -->
            </div>
        </template>
    </div>

    <!-- Hidden Input for Form Submission -->
    <input type="hidden" name="{{ $attributes->get('name') }}" :value="selected">
</div>

<!-- Alpine.js Logic -->
<script>
    function dropdown() {
        return {
            open: false,
            selected: @json($selected),
            options: @json($options),

            selectedLabel() {
                return this.selected ? this.options[this.selected] : '';
            },

            selectItem(key) {
                this.selected = key;
                this.open = false; // Close dropdown after selection
            }
        };
    }
</script>
