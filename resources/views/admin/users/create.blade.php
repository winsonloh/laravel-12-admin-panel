<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/user.create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="name" :value="__('admin/user.attributes.name')" :required="true" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="username" :value="__('admin/user.attributes.username')" :required="true" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('admin/user.attributes.email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="role" :value="__('admin/user.attributes.role')" :required="true" />
                            <x-select-input
                                :options="$roles->map(function($role) {
                                    return ucwords(str_replace('_', ' ', $role));
                                })"
                                id="role"
                                name="role"
                                class="mt-1 block w-full"
                            />
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('admin/user.attributes.password')" :required="true" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('admin/user.attributes.password_confirmation')" :required="true" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('admin/user.attributes.status')" :required="true" />
                            <x-select-input
                                :options="[
                                    'active' => __('admin/user.status.active'),
                                    'inactive' => __('admin/user.status.inactive'),
                                ]"
                                id="status"
                                name="status"
                                class="mt-1 block w-full"
                            />
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.users.index') }}">
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
