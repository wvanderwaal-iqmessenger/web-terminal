<?php

declare(strict_types=1);

namespace MWGuerra\WebTerminal\Data;

use InvalidArgumentException;

/**
 * Fluent builder and DTO for a group of scripts or nested groups.
 *
 * A ScriptGroup appears in the scripts dropdown as a folder that the user can
 * navigate into, revealing its child scripts or nested ScriptGroups.
 */
class ScriptGroup
{
    protected string $key;

    protected string $label;

    protected ?string $description = null;

    protected string $icon = 'heroicon-o-folder';

    /** @var array<int, Script|ScriptGroup> */
    protected array $items = [];

    private function __construct(string $key)
    {
        $this->key = $key;
        $this->label = $key;
    }

    /**
     * Create a new script group with the given key.
     */
    public static function make(string $key): static
    {
        if (trim($key) === '') {
            throw new InvalidArgumentException('ScriptGroup key cannot be empty.');
        }

        return new static($key);
    }

    /**
     * Set the display label for the group.
     */
    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set an optional description for the group.
     */
    public function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the icon for the group (Heroicon format).
     */
    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the child scripts and/or nested groups.
     *
     * @param  array<int, Script|ScriptGroup>  $items
     */
    public function items(array $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    /** @return array<int, Script|ScriptGroup> */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Convert to array representation (recursive).
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => 'group',
            'key' => $this->key,
            'label' => $this->label,
            'description' => $this->description,
            'icon' => $this->icon,
            'items' => array_map(fn ($item) => $item->toArray(), $this->items),
        ];
    }
}
