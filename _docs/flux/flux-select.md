# Select Component

The Select component allows users to choose a single option from a dropdown list. It provides a clean and intuitive interface for making selections from a list of options.

## Basic Usage

The basic Select component provides a simple dropdown interface for selecting a single option:

```blade
<flux:select wire:model="industry" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <flux:select.option>Web development</flux:select.option>
    <flux:select.option>Accounting</flux:select.option>
    <flux:select.option>Legal services</flux:select.option>
    <flux:select.option>Consulting</flux:select.option>
    <flux:select.option>Other</flux:select.option>
</flux:select>
```

## Sizes

The Select component supports different sizes to fit various layout needs:

### Small Size
For more compact layouts, use the `size="sm"` prop:

```blade
<flux:select size="sm" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <!-- ... more options ... -->
</flux:select>
```

## Pro Features

### Custom Select (Pro)
The custom select variant provides enhanced styling options, including support for icons, images, and custom option treatments:

```blade
<flux:select variant="listbox" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <!-- ... more options ... -->
</flux:select>
```

### Multiple Select (Pro)
Allow users to select multiple options:

```blade
<flux:select variant="listbox" multiple placeholder="Choose industries...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <!-- ... more options ... -->
</flux:select>
```

### Combobox (Pro)
A versatile combobox that supports both selection and search functionality:

```blade
<flux:select variant="combobox" placeholder="Choose industry...">
    <flux:select.option>Photography</flux:select.option>
    <flux:select.option>Design services</flux:select.option>
    <!-- ... more options ... -->
</flux:select>
```

## Customization

### Selected Suffix
When using multiple selection, you can customize the suffix that appears after the selected count:

```blade
<flux:select 
    variant="listbox" 
    selected-suffix="industries selected" 
    multiple
>
    <!-- options -->
</flux:select>
```

For localization support:
```blade
<flux:select 
    variant="listbox" 
    selected-suffix="{{ __('industries selected') }}" 
    multiple
>
    <!-- options -->
</flux:select>
```

## Component Reference

### Props

#### flux:select
| Prop              | Type    | Default    | Description                                     |
| ----------------- | ------- | ---------- | ----------------------------------------------- |
| `wire:model`      | string  | -          | Livewire model binding                          |
| `placeholder`     | string  | -          | Placeholder text when no option is selected     |
| `size`            | string  | 'default'  | Size variant ('sm', 'default')                  |
| `variant`         | string  | 'default'  | Visual style ('default', 'listbox', 'combobox') |
| `multiple`        | boolean | false      | Enable multiple selection                       |
| `selected-suffix` | string  | 'selected' | Suffix for multiple selection count             |

#### flux:select.option
| Prop       | Type    | Default | Description                    |
| ---------- | ------- | ------- | ------------------------------ |
| `value`    | mixed   | -       | The value of the option        |
| `disabled` | boolean | false   | Whether the option is disabled |

## Accessibility
- The Select component is keyboard accessible
- Uses appropriate ARIA attributes for screen readers
- Supports keyboard navigation through options
- Maintains focus management for dropdown interaction

## Best Practices
1. Use Select when you have 6 or more options
2. For 5 or fewer options, consider using radio buttons instead
3. Provide clear, descriptive placeholder text
4. Group related options together
5. Consider using the searchable variant for long lists
6. Include a default or placeholder option when appropriate

## CSS Features
The Select component can be styled using standard CSS classes and custom properties:

```css
.flux-select {
    /* Custom styles */
}

.flux-select-option {
    /* Option styles */
}
``` 