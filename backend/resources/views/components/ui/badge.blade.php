@php
    $style = $style();

    $variantClass = match ($variant) {
        \App\Enums\Ui\BadgeVariant::Primary => $style->primary(),
        \App\Enums\Ui\BadgeVariant::Success => $style->success(),
        \App\Enums\Ui\BadgeVariant::Warning => $style->warning(),
        \App\Enums\Ui\BadgeVariant::Danger => $style->danger(),
        \App\Enums\Ui\BadgeVariant::Info => $style->info(),
        \App\Enums\Ui\BadgeVariant::Secondary => $style->secondary(),
        default => $style->secondary(),
    };
@endphp

<span {{ $attributes->class([
    $style->wrapper(),
    $variantClass,
]) }}>
    {{ $slot }}
</span>