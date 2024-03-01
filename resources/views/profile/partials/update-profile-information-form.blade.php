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

  <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required
        autofocus autocomplete="name" />
      <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
      <x-input-label for="username" :value="__('Username')" />
      <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required
        autofocus autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('username')" />
    </div>

    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required
        autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />

      {{-- TODO : UN COMMENT CODE TO FIX VERIFED AN EMAIL --}}
      {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div>
          <p class="text-sm mt-2 text-gray-800">
            {{ __('Your email address is unverified.') }}

            <button form="send-verification"
              class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-sm text-green-600">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif --}}
    </div>

    <div>
      <x-input-label for="photo" :value="__('Photo Profile')" />
      <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" :value="old('photo', $user->photo)" autofocus
        autocomplete="photo" />
      @if ($user->photo)
        <img src="{{ asset($user->photo) }}" alt="photo" class="mt-2"
          style="width: 100px; height: 100px; object-fit: cover; object-position: center;">
      @endif
      <x-input-error class="mt-2" :messages="$errors->get('photo')" />
    </div>

    <div>
      <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
      <div class="mt-1">
        <label for="jenis_kelamin_laki" class="inline-flex items-center">
          <input id="jenis_kelamin_laki" name="jenis_kelamin" type="radio" value="Laki-Laki" class="form-radio"
            @if (old('jenis_kelamin', $user->jenis_kelamin) === 'Laki-Laki') checked @endif required autofocus autocomplete="jenis_kelamin" />
          <span class="ml-2">{{ __('Laki-Laki') }}</span>
        </label>
        <label for="jenis_kelamin_perempuan" class="inline-flex items-center ml-6">
          <input id="jenis_kelamin_perempuan" name="jenis_kelamin" type="radio" value="Perempuan" class="form-radio"
            @if (old('jenis_kelamin', $user->jenis_kelamin) === 'Perempuan') checked @endif required autofocus autocomplete="jenis_kelamin" />
          <span class="ml-2">{{ __('Perempuan') }}</span>
        </label>
      </div>
      <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
    </div>

    <div>
      <x-input-label for="alamat" :value="__('Alamat')" />
      <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" :value="old('alamat', $user->alamat)" required
        autofocus autocomplete="alamat" />
      <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
          {{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
