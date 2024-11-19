<div>
    <x-button @click="$wire.set('createUserModal','true')">Create User</x-button>

    <x-dialog-modal id="createUserModal" wire:model.live="createUserModal" submit="save">
        <x-slot name="title">
            Add New User
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.first_name" value="{{ __('First Name') }}" />
                    <x-input id="form.first_name" type="text" class="block w-full mt-1" wire:model="form.first_name"
                        required autocomplete="form.first_name" />
                    <x-input-error for="form.first_name" class="mt-2" />
                </div>

                <div class="col-span-full sm:col-span-4">
                    <x-label for="form.last_name" value="{{ __('Last Name') }}" />
                    <x-input id="form.last_name" type="text" class="block w-full mt-1" wire:model="form.last_name"
                        autocomplete="form.last_name" />
                    <x-input-error for="form.last_name" class="mt-2" />
                </div>

                <!-- userName -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.username" value="{{ __('Username') }}" />
                    <x-input id="form.username" type="text" class="block w-full mt-1" wire:model="form.username"
                        required autocomplete="form.username" />
                    <x-input-error for="form.username" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-full sm:col-span-4">
                    <x-label for="form.email" value="{{ __('Email') }}" />
                    <x-input id="form.email" type="email" class="block w-full mt-1" wire:model="form.email" required
                        autocomplete="form.email" />
                    <x-input-error for="form.email" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="col-span-full sm:col-span-4">
                    <x-label for="form.password" value="{{ __('Password') }}" />
                    <x-input id="form.password" type="password" class="block w-full mt-1" wire:model="form.password"
                        required autocomplete="form.password" />
                    <x-input-error for="form.password" class="mt-2" />
                </div>

                <!-- Password Confirmation -->
                <div class="col-span-full sm:col-span-4">
                    <x-label for="form.password_confirmation" value="{{ __('Password Confirmation') }}" />
                    <x-input id="form.password_confirmation" type="password" class="block w-full mt-1" required
                        autocomplete="form.password_confirmation" />
                    <x-input-error for="form.password_confirmation" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="set('createUserModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>