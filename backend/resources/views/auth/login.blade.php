<x-guest-layout>

    <x-ui.card>

        <x-slot:header>
            <h1>Asset Procurement System</h1>
            <p>Sign in to continue.</p>
        </x-slot:header>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <x-ui.input
                name="email"
                type="email"
                label="Email"
                :value="old('email')"
                required
                autofocus
            />

            <x-ui.input
                name="password"
                type="password"
                label="Password"
                required
            />

            <x-ui.checkbox
                name="remember"
                label="Remember Me"
            />

            <x-ui.button
                type="submit"
                class="w-full"
            >
                Sign In
            </x-ui.button>

        </form>

    </x-ui.card>

</x-guest-layout>