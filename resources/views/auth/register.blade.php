<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nombre(s)')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!--Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Apellido(s)')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!--Identification Number -->
        <div class="mt-4">
            <x-input-label for="identification_number" :value="__('Numero de Identificación (CI/PASAPORTE)')" />
            {{-- <x-text-input id="identification_number" class="block mt-1 w-full" type="number" name="identification_number" :value="old('identification_number')" required autofocus autocomplete="identification_number" />   
                      --}}
            <x-text-input id="identification_number" class="block mt-1 w-full" type="number" name="identification_number" :value="old('identification_number')" required autofocus autocomplete="identification_number" />
            <x-input-error :messages="$errors->get('identification_number')" class="mt-2" />
        </div>

        <!--Nationalities-->
        <div class="mt-4">
            <x-input-label for="nationality_id" :value="__('Nacionalidad')" />
            <select id="nationality_id" name="nationality_id" class="block mt-1 w-full" required>
                <option value="">Selecciona tu nacionalidad</option>
                @foreach($nationalities as $nationality)
                    <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('nationality_id')" class="mt-2" />
        </div>

        <!--Birthday-->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Fecha de Nacimiento')" />
            <input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />            
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!--Phone-->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Número de contacto')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />            
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        
        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
