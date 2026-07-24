@extends('layouts.showcase')

@section('title', 'UI Showcase')

@section('content')

<h1 class="text-h1 font-semibold mb-lg">
    UI Showcase
</h1>

<div class="space-y-8">

    <div class="rounded-xl border shadow-lg bg-white p-6">
        Built-in utilities
    </div>

    <div class="rounded-card border border-border shadow-card bg-card p-6">
        Custom utilities
    </div>

    <div class="grid gap-6">

        <x-ui.card>
            Simple Card
        </x-ui.card>

        <x-ui.card variant="outlined">
            Outlined Card
        </x-ui.card>

        <x-ui.card variant="elevated">
            Elevated Card
        </x-ui.card>

        <x-ui.card>

            <x-slot:header>
                Gold Price Prediction
            </x-slot:header>

            Predicted price for tomorrow:
            <strong>$3,420</strong>

            <x-slot:footer>
                Updated 5 minutes ago
            </x-slot:footer>

        </x-ui.card>

    </div>

    {{-- Badge Showcase --}}

<div class="space-y-4">

    <h2 class="text-h2 font-semibold">
        Badges
    </h2>

    <div class="flex flex-wrap gap-3">

        <x-ui.badge>
            Primary
        </x-ui.badge>

        <x-ui.badge variant="success">
            Success
        </x-ui.badge>

        <x-ui.badge variant="warning">
            Warning
        </x-ui.badge>

        <x-ui.badge variant="danger">
            Danger
        </x-ui.badge>

        <x-ui.badge variant="info">
            Info
        </x-ui.badge>

        <x-ui.badge variant="secondary">
            Secondary
        </x-ui.badge>

    </div>

</div>

{{-- Input Showcase --}}

<div class="space-y-6">

    <h2 class="text-h2 font-semibold">
        Inputs
    </h2>

    <div class="grid gap-6 max-w-xl">

        <x-ui.input
            name="title"
            label="Title"
            placeholder="Enter title..."
            hint="Maximum 255 characters"
        />

        <x-ui.input
            name="email"
            type="email"
            label="Email"
            placeholder="example@email.com"
        />

        <x-ui.input
            name="price"
            type="number"
            label="Gold Price"
            placeholder="0.00"
        />

        <x-ui.input
            name="password"
            type="password"
            label="Password"
        />

        <x-ui.input
            name="disabled"
            label="Disabled"
            value="Disabled value"
            disabled
        />

        <x-ui.input
            name="readonly"
            label="Read Only"
            value="Read only value"
            readonly
        />

        <x-ui.input
            name="required"
            label="Required Field"
            required
        />

    </div>

</div>

{{-- Textarea Showcase --}}

<div class="space-y-6">

    <h2 class="text-h2 font-semibold">
        Textareas
    </h2>

    <div class="grid gap-6 max-w-xl">

        <x-ui.textarea
            name="description"
            label="Description"
            placeholder="Write your description..."
            hint="Maximum 1000 characters"
        />

        <x-ui.textarea
            name="notes"
            label="Notes"
            rows="8"
        />

        <x-ui.textarea
            name="readonly_notes"
            label="Read Only"
            value="This textarea is read only."
            readonly
        />

        <x-ui.textarea
            name="disabled_notes"
            label="Disabled"
            value="This textarea is disabled."
            disabled
        />

        <x-ui.textarea
            name="required_notes"
            label="Required"
            required
        />

    </div>

</div>

{{-- Select Showcase --}}

<div class="space-y-6">

    <h2 class="text-h2 font-semibold">
        Selects
    </h2>

    <div class="grid gap-6 max-w-xl">

        <x-ui.select
            name="status"
            label="Status"
            placeholder="Select status..."
            :options="[
                'pending' => 'Pending',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ]"
        />

        <x-ui.select
            name="branch"
            label="Branch"
            :options="[
                1 => 'Jakarta',
                2 => 'Bandung',
                3 => 'Surabaya',
                4 => 'Semarang',
            ]"
        />

        <x-ui.select
            name="disabled_status"
            label="Disabled"
            disabled
            :options="[
                'active' => 'Active',
                'inactive' => 'Inactive',
            ]"
        />

        <x-ui.select
            name="required_status"
            label="Required"
            required
            :options="[
                'yes' => 'Yes',
                'no' => 'No',
            ]"
        />

    </div>

</div>

{{-- Checkbox Showcase --}}

<div class="space-y-6">

    <h2 class="text-h2 font-semibold">
        Checkboxes
    </h2>

    <div class="space-y-5 max-w-xl">

        <x-ui.checkbox
            name="remember"
            label="Remember Me"
        />

        <x-ui.checkbox
            name="newsletter"
            label="Subscribe to Newsletter"
            hint="Receive weekly market updates."
        />

        <x-ui.checkbox
            name="terms"
            label="I agree to the Terms and Conditions"
            required
        />

        <x-ui.checkbox
            name="enabled"
            label="Enable AI Prediction"
            checked
        />

        <x-ui.checkbox
            name="disabled"
            label="Disabled Checkbox"
            disabled
        />

    </div>

</div>

{{-- Radio Showcase --}}

<div class="space-y-6">

    <h2 class="text-h2 font-semibold">
        Radios
    </h2>

    <div class="space-y-5 max-w-xl">

        <x-ui.radio
            name="status"
            label="Pending"
            value="pending"
        />

        <x-ui.radio
            name="status"
            label="Approved"
            value="approved"
            checked
        />

        <x-ui.radio
            name="status"
            label="Rejected"
            value="rejected"
        />

        <x-ui.radio
            name="priority"
            label="High Priority"
            value="high"
            hint="Used for urgent predictions."
        />

        <x-ui.radio
            name="disabled"
            label="Disabled"
            value="disabled"
            disabled
        />

    </div>

</div>

</div>



@endsection