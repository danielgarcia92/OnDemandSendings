<x-jet-authentication-card>
    <x-slot name="logo">
        <x-jet-authentication-card-logo />
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{ url("register/CreateUser") }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div>
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <x-jet-label for="rol" value="{{ __('Rol') }}" />
            <select id="rol" name="rol" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value=""></option>
                <option value="asa">ASA</option>
                <option value="gdl">GDL</option>
                <option value="mex">MEX</option>
                <option value="nlu">NLU</option>
                <option value="ccv">CCV</option>
                <option value="acdm">ACDM</option>
                <option value="jt">Jefe de turno CCV</option>
                <!--<option value="admin">Administrador</option>-->
                <option value="cat">Centro de Atención Tecnológica</option>
            </select>
        </div>

        <div class="mt-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4">
                {{ __('Register') }}
            </x-jet-button>
        </div>
    </form>
</x-jet-authentication-card>
