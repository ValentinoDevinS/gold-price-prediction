<?php

namespace App\View\Components\Ui;

use App\Enums\Ui\InputSize;
use App\Support\Ui\Styles\InputStyle;
use App\View\Components\FieldComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Input extends FieldComponent
{
    public string $type;
    public string $id;
    public string $name;
    public string $label;
    public ?string $value;
    public string $placeholder;
    public string $hint;

    public bool $required;
    public bool $readonly;
    public bool $disabled;

    public InputSize $size;

    public function __construct(
        string $type = 'text',
        ?string $id = null,
        string $name = '',
        string $label = '',
        ?string $value = null,
        string $placeholder = '',
        string $hint = '',
        string $size = 'md',
        bool $required = false,
        bool $readonly = false,
        bool $disabled = false,
    ) {
        $this->type = $type;

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

        $this->size = InputSize::tryFrom($size)
            ?? InputSize::Medium;
    }

    /**
     * Whether this input currently has a validation error.
     */
    public function hasError(): bool
    {
        return $this->name !== '' && $errors = session('errors')
            ? $errors->has($this->name)
            : false;
    }

    /**
     * Build Tailwind classes.
     */
    public function classes(): string
    {
        return InputStyle::make(
            $this->size,
            $this->hasError(),
            $this->disabled,
        );
    }

    /**
     * Get the first validation error.
     */
    public function errorMessage(): ?string
    {
        if (! $this->hasError()) {
            return null;
        }

        return session('errors')->first($this->name);
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.input');
    }
}