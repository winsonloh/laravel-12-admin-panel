@props(['options' => [], 'selected' => []])

<div x-data="dropdown()" class="relative w-full">
    <!-- Display Selected Values as Pills -->
    <div class="border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm p-2 cursor-pointer bg-white flex flex-wrap gap-1 min-h-[40px]" 
         @click="open = !open">
        
        <!-- If items are selected, show them as pills -->
        <template x-for="(label, index) in selectedLabels()" :key="index">
            <span class="bg-indigo-100 text-indigo-700 text-sm px-2 py-1 rounded-md flex items-center space-x-1">
                <span x-text="label"></span>
                <button type="button" @click.stop="removeItem(index)" class="ml-1 text-red-500 hover:text-red-700">&times;</button>
            </span>
        </template>

        <!-- Placeholder text when nothing is selected -->
        <span x-show="selected.length === 0" class="text-gray-500">{{ __('global.select') }}</span>
    </div>

    <!-- Dropdown Menu -->
    <div x-show="open" 
         @click.away="open = false"
         class="absolute z-50 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg p-2 max-h-72 overflow-y-auto">
        
        <!-- Search Input -->
        <input type="text" x-model="search" placeholder="{{ __('global.search') }}"
               class="w-full border border-gray-300 rounded-md p-1 mb-2 focus:ring-indigo-500 focus:border-indigo-500">

        <!-- Action Buttons -->
        <div class="flex justify-between mb-2">
            <button type="button" @click="selectAll()" class="text-indigo-600 hover:underline text-sm">{{ __('global.select_all') }}</button>
            <button type="button" @click="deselectAll()" class="text-red-600 hover:underline text-sm">{{ __('global.deselect_all') }}</button>
        </div>

        <!-- Options List -->
        <template x-for="(option, key) in filteredOptions()" :key="key">
            <label class="flex items-center space-x-2 p-2 hover:bg-gray-100 rounded-md cursor-pointer">
                <input type="checkbox" :value="key" x-model="selected" class="form-checkbox text-indigo-600">
                <span x-text="option" class="text-gray-700"></span>
            </label>
        </template>
    </div>

    <!-- Hidden Inputs to Submit Selected Values as an Array -->
    <template x-for="(value, index) in selected" :key="index">
        <input type="hidden" name="permissions[]" :value="value">
    </template>
</div>

<!-- Alpine.js Logic -->
<script>
    function dropdown() {
        return {
            open: false,
            search: '',
            selected: @json($selected),
            options: @json($options),

            selectedLabels() {
                return this.selected.map(id => this.options[id] || '');
            },

            filteredOptions() {
                return Object.fromEntries(Object.entries(this.options).filter(([key, value]) => 
                    value.toLowerCase().includes(this.search.toLowerCase())
                ));
            },

            selectAll() {
                this.selected = Object.keys(this.options);
            },

            deselectAll() {
                this.selected = [];
            },

            removeItem(index) {
                this.selected.splice(index, 1);
            }
        };
    }
</script>
