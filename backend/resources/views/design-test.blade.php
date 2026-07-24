<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background p-xl">

<div class="bg-card rounded-card shadow-card p-lg max-w-md">

    <h1 class="text-xl font-semibold text-text">
        Design System Test
    </h1>

    <p class="text-text-secondary mt-sm">
        If this card looks clean, our Tailwind theme is working.
    </p>

    <button
        class="mt-lg bg-primary hover:bg-primary-hover text-white rounded-button px-lg py-sm transition-all duration-normal">
        Test Button
    </button>

</div>

</body>
</html>