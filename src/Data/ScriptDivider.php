<?php

declare(strict_types=1);

namespace MWGuerra\WebTerminal\Data;

/**
 * Fluent builder and DTO for a divider between scripts.
 *
 * A ScriptDivider appears in the scripts dropdown as a horizontal rule that
 * visually separates the items around it, optionally captioned with a label.
 * It is not runnable and cannot be navigated into.
 */
class ScriptDivider
{
    protected ?string $label = null;

    private function __construct() {}

    /**
     * Create a new divider, optionally captioned with the given label.
     */
    public static function make(?string $label = null): static
    {
        return (new static)->label($label);
    }

    /**
     * Set the optional caption shown on the divider.
     */
    public function label(?string $label): static
    {
        $this->label = $label === null || trim($label) === '' ? null : $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Convert to array representation.
     *
     * @return array{type: string, label: string|null}
     */
    public function toArray(): array
    {
        return [
            'type' => 'divider',
            'label' => $this->label,
        ];
    }
}
