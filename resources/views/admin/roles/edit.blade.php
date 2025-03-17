<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/role.edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('admin.roles.update', $role->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="name" :value="__('admin/role.attributes.name')" :required="true" />
                            <x-text-input id="name" name="name" type="text" value="{{ $role->name }}" class="mt-1 block w-full" autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="permissions" :value="__('admin/role.attributes.permissions')" :required="true" />
                            <x-select-multi-input
                                :options="$permissions"
                                :selected="$role->permissions->pluck('id')->toArray()"
                                class="mt-1 block w-full"
                                name="permissions"
                            />
                            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.roles.index') }}">
                                <x-secondary-button>{{ __('global.back') }}</x-secondary-button>
                            </a>
                            <x-primary-button>{{ __('global.save') }}</x-primary-button>

                            @if (session('status') === 'role-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('global.saved') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
