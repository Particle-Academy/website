# Switch Component

The Switch component provides a toggle control for binary (on/off) settings. It's ideal for enabling or disabling features and is designed to provide immediate feedback through a simple, intuitive interface.

> **Best Practice**: Use switches for auto-saving controls outside forms. For form-based binary choices, consider using checkboxes instead.

## Basic Usage

The basic Switch component with a label:

```blade
<flux:switch 
    wire:model.live="notifications" 
    label="Enable notifications" 
/>
```

## Fieldset Groups

Group related switches within a fieldset for better organization:

```blade
<flux:fieldset>
    <flux:legend>Email notifications</flux:legend>
    <div class="space-y-4">
        <flux:switch 
            wire:model.live="communication" 
            label="Communication emails" 
            description="Receive emails about your account activity." 
        />
        <flux:separator variant="subtle" />
        <flux:switch 
            wire:model.live="marketing" 
            label="Marketing emails" 
            description="Receive emails about new products, features, and more." 
        />
        <flux:separator variant="subtle" />
        <flux:switch 
            wire:model.live="social" 
            label="Social emails" 
            description="Receive emails for friend requests, follows, and more." 
        />
    </div>
</flux:fieldset>
```

## Alignment Options

### Left-Aligned Switches
Use the `align="left"` prop for more compact layouts:

```blade
<flux:fieldset>
    <flux:legend>Email notifications</flux:legend>
    <div class="space-y-3">
        <flux:switch label="Communication emails" align="left" />
        <flux:switch label="Marketing emails" align="left" />
        <flux:switch label="Social emails" align="left" />
    </div>
</flux:fieldset>
```

## Component Reference

### Props

| Prop          | Type    | Default | Description                                               |
| ------------- | ------- | ------- | --------------------------------------------------------- |
| `wire:model`  | string  | -       | Binds the switch to a Livewire property                   |
| `name`        | string  | -       | Name attribute (auto-set when using wire:model)           |
| `label`       | string  | -       | Label text displayed with the switch                      |
| `description` | string  | -       | Help text displayed below the switch                      |
| `align`       | string  | 'right' | Alignment relative to label ('right\|start', 'left\|end') |
| `disabled`    | boolean | false   | Prevents user interaction                                 |

### Attributes

| Attribute          | Description                                        |
| ------------------ | -------------------------------------------------- |
| `data-flux-switch` | Applied to root element for styling/identification |
| `data-checked`     | Applied when switch is in "on" state               |

## Accessibility

The Switch component follows accessibility best practices:
- Uses proper ARIA attributes for toggle state
- Supports keyboard navigation
- Provides clear visual feedback
- Associates labels with controls

## Best Practices

1. Use switches for immediate actions that:
   - Take effect immediately
   - Don't require form submission
   - Toggle between two states

2. Use checkboxes instead when:
   - The control is part of a form
   - Multiple related options can be selected
   - The change requires explicit submission

3. Always provide clear labels that:
   - Describe the feature being toggled
   - Use positive language
   - Indicate current state

4. Group related switches:
   - Use fieldsets for logical grouping
   - Provide clear group labels
   - Consider using separators between items

## CSS Customization

The Switch component can be styled using CSS custom properties:

```css
.flux-switch {
    /* Switch track styles */
    --switch-track-width: 36px;
    --switch-track-height: 20px;
    
    /* Switch thumb styles */
    --switch-thumb-size: 16px;
    --switch-thumb-color: white;
    
    /* Colors */
    --switch-track-checked: theme(colors.primary.600);
    --switch-track-unchecked: theme(colors.gray.200);
}
``` 