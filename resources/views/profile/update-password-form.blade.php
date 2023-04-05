<x-form-section submit="updatePassword"  class="py-5 ">
    <x-slot name="title">
        {{ __('word.Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('word.Ensure your account') }}
    </x-slot>

    <x-slot name="form">
        <div
            @if ($setting->translate(app()->getlocale())->title == 'العربية') 
                style="direction: rtl;"
            @endif
        >

            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" value="{{ __('word.Current Password') }}" />
                <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('word.New Password') }}" />
                <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="{{ __('word.Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>
       
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('word.saved') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" style="color: #ffffff;
        background: #38b6ff;">
            {{ __('word.save') }}
        </x-button>
    </x-slot>
</x-form-section>
