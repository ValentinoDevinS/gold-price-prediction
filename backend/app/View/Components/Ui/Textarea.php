<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

use App\Enums\Ui\InputSize;
use App\Enums\Ui\TextareaResize;
use App\Support\Ui\Styles\TextareaStyle;
use App\View\Components\FieldComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Textarea extends FieldComponent
{
    public ?string $value;

    public int $rows;

    public InputSize $size;

    public TextareaResize $resize;

    public function __construct(
        ?string $id = null,
        string $name = '',
        string $label = '',
        ?string $value = null,
        string $placeholder = '',
        string $hint = '',
        string $size = 'md',
        int $rows = 5,
        string $resize = 'vertical',
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

        $this->rows = $rows;

        $this->size = InputSize::tryFrom($size)
            ?? InputSize::Medium;

        $this->resize = TextareaResize::tryFrom($resize)
            ?? TextareaResize::Vertical;
    }

    /**
     * Style object.
     */
    public function style(): TextareaStyle
    {
        return new TextareaStyle();
    }

    /**
     * Whether the field has validation errors.
     */
    public function hasError(): bool
    {
        $errors = session('errors');

        return $this->name !== ''
            && $errors
            && $errors->has($this->name);
    }

    /**
     * First validation error.
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
        return view('components.ui.textarea');
    }
}