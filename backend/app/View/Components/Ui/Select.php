<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\InputSize;
use App\Support\Ui\Styles\SelectStyle;
use App\View\Components\FieldComponent;
use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class Select extends FieldComponent
{
    /**
     * Selected value.
     */
    public mixed $value;

    /**
     * Select options.
     */
    public iterable $options;

    /**
     * Placeholder option.
     */
    public string $placeholderOption;

    /**
     * Input size.
     */
    public InputSize $size;

    public function __construct(
        ?string $id = null,
        string $name = '',
        string $label = '',
        mixed $value = null,
        iterable|Arrayable $options = [],
        string $placeholder = 'Please select...',
        string $hint = '',
        string $size = 'md',
        bool $required = false,
        bool $readonly = false,
        bool $disabled = false,
    ) {
        $this->initializeField(
            id: $id,
            name: $name,
            label: $label,
            hint: $hint,
            placeholder: $placeholder,
            required: $required,
            readonly: $readonly,
            disabled: $disabled,
        );

        $this->value = old($name, $value);

        $this->options = $options instanceof Arrayable
            ? $options->toArray()
            : $options;

        $this->placeholderOption = $placeholder;

        $this->size = InputSize::tryFrom($size)
            ?? InputSize::Medium;
    }

    /**
     * Determine whether an option is selected.
     */
    public function isSelected(mixed $value): bool
    {
        return (string) $this->value === (string) $value;
    }

    /**
     * Build Tailwind classes.
     */
    public function classes(): string
    {
        return SelectStyle::make(
            $this->size,
            $this->hasError(),
            $this->disabled,
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.select');
    }
}