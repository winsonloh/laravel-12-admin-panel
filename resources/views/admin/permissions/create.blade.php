<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/permission.create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('admin.permissions.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="name" :value="__('admin/permission.attributes.name')" :required="true" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.permissions.index') }}">
                                <x-secondary-button>{{ __('global.back') }}</x-secondary-button>
                            </a>
                            <x-primary-button>{{ __('global.save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
