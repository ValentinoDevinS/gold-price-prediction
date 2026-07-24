<?php

namespace App\View\Components;

abstract class FieldComponent extends BaseComponent
{
    public string $id;

    public string $name;

    public string $label;

    public string $hint;

    public string $placeholder;

    public bool $required;

    public bool $readonly;

    public bool $disabled;

    public ?string $error = null;

    protected function initializeField(
        ?string $id,
        string $name,
        string $label,
        string $hint,
        string $placeholder,
        bool $required,
        bool $readonly,
        bool $disabled,
    ): void {
        $this->name = $name;
        $this->id = $id ?: $name;

        $this->label = $label;
        $this->hint = $hint;
        $this->placeholder = $placeholder;

        $this->required = $required;
        $this->readonly = $readonly;
        $this->disabled = $disabled;

        $this->error = session('errors')?->first($name);
    }

    public function hasError(): bool
    {
        return filled($this->error);
    }
}