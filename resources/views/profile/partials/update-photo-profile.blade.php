<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <img src="{{Storage::url($user->avatar)}}" id="avatar-preview" class="w-[120px] h-[120px] rounded-full mt-4 object-cover object-center" />

    <form method="post" action="{{ route('profile.update_photo', $user) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mt-4">
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" class="block mt-1 w-full" type="file" name="avatar" required autofocus autocomplete="avatar" />
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>


    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file && file.type.startsWith('image/')) {
            document.getElementById('avatar-preview').src = URL.createObjectURL(file);
        } else {
            alert('Please select a valid image file.');
            event.target.value = ''; // Clear the input
        }
        });
    </script>
</section>
