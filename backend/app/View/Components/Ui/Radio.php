<?php

namespace App\View\Components\Ui;

use App\Support\Ui\Styles\RadioStyle;
use App\View\Components\FieldComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Radio extends FieldComponent
{
    /**
     * Radio value.
     */
    public string $value;

    /**
     * Default checked state.
     */
    public bool $checked;

    public function __construct(
        ?string $id = null,
        string $name = '',
        string $label = '',
        string $value = '',
        string $hint = '',
        bool $checked = false,
        bool $required = false,
        bool $readonly = false,
        bool $disabled = false,
    ) {
        $this->initializeField(
            id: $id,
            name: $name,
            label: $label,
            hint: $hint,
            placeholder: '',
            required: $required,
            readonly: $readonly,
            disabled: $disabled,
        );

        $this->value = $value;

        /*
         * Laravel old() takes priority after validation.
         */
        $this->checked = old(
            $name,
            $checked ? $value : null
        ) == $value;
    }

    /**
     * Build Tailwind classes.
     */
    public function classes(): string
    {
        return RadioStyle::make(
            $this->hasError(),
            $this->disabled,
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.ui.radio');
    }
}