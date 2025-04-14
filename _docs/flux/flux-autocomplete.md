# Flux Autocomplete Component

Enhance an input field with autocomplete suggestions, providing users with a searchable dropdown of options as they type.

## Basic Usage

```blade
<flux:autocomplete wire:model="state" label="State of residence">
    <flux:autocomplete.item>Alabama</flux:autocomplete.item>
    <flux:autocomplete.item>Arkansas</flux:autocomplete.item>
    <flux:autocomplete.item>California</flux:autocomplete.item>
    <flux:autocomplete.item>Colorado</flux:autocomplete.item>
    <!-- ... more states ... -->
</flux:autocomplete>
```

## Variants

### With Label and Description

```blade
<flux:autocomplete label="Location" description="Select your primary residence">
    <!-- items -->
</flux:autocomplete>
```

### With Custom Item Display

```blade
<flux:autocomplete wire:model="country">
    <flux:autocomplete.item value="us">
        <div class="flex items-center">
            <img src="/flags/us.svg" class="w-4 h-4 mr-2">
            United States
        </div>
    </flux:autocomplete.item>
    <!-- more items -->
</flux:autocomplete>
```

### With Search Placeholder

```blade
<flux:autocomplete placeholder="Search states...">
    <!-- items -->
</flux:autocomplete>
```

### Disabled State

```blade
<flux:autocomplete disabled>
    <!-- items -->
</flux:autocomplete>
```

## Example Use Cases

### Country Selection
```blade
<flux:autocomplete wire:model="country" label="Select Country">
    <flux:autocomplete.item>United States</flux:autocomplete.item>
    <flux:autocomplete.item>Canada</flux:autocomplete.item>
    <flux:autocomplete.item>United Kingdom</flux:autocomplete.item>
    <!-- more countries -->
</flux:autocomplete>
```

### Tag Selection
```blade
<flux:autocomplete wire:model="tags" label="Add Tags" multiple>
    <flux:autocomplete.item>PHP</flux:autocomplete.item>
    <flux:autocomplete.item>Laravel</flux:autocomplete.item>
    <flux:autocomplete.item>Livewire</flux:autocomplete.item>
    <!-- more tags -->
</flux:autocomplete>
```

## Reference

### flux:autocomplete

| Prop | Description |
|------|-------------|
| label | The label text displayed above the input |
| description | Additional context displayed below the label |
| placeholder | Placeholder text shown when no value is selected |
| disabled | When true, prevents user interaction |
| multiple | When true, allows selecting multiple items |
| wire:model | Livewire model binding for the selected value(s) |

### flux:autocomplete.item

| Prop | Description |
|------|-------------|
| value | Optional value to be used instead of the item's content |
| disabled | When true, prevents this item from being selected |

### Events

| Event | Description |
|-------|-------------|
| change | Fired when the selected value changes |
| search | Fired when the user types in the search input |
| open | Fired when the dropdown opens |
| close | Fired when the dropdown closes | 