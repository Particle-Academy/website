# Flux Label Component

A form label component that provides consistent styling and accessibility features for form controls. The Label component can be used independently or as part of the Field component system.

## Basic Usage

```blade
<flux:label>Email</flux:label>
```

## With Badge

Add optional badges to indicate field requirements:

```blade
<!-- Required field -->
<flux:label badge="Required">Email</flux:label>

<!-- Optional field -->
<flux:label badge="Optional">Phone number</flux:label>
```

## Within Field Context

Labels are commonly used within the Field component:

```blade
<flux:field>
    <flux:label>Username</flux:label>
    <flux:input wire:model="username" />
    <flux:error name="username" />
</flux:field>
```

## Shorthand Syntax

Most form components accept a `label` prop for convenience:

```blade
<flux:input 
    label="Email" 
    wire:model="email" 
    type="email"
/>
```

## With Description

Combine labels with descriptions for additional context:

```blade
<flux:field>
    <flux:label>Password</flux:label>
    <flux:description>
        Must be at least 8 characters long.
    </flux:description>
    <flux:input type="password" wire:model="password" />
</flux:field>
```

## For Checkbox and Radio Groups

Labels can be used with grouped form controls:

```blade
<flux:field>
    <flux:label>Notification preferences</flux:label>
    <div class="space-y-2">
        <flux:checkbox label="Email notifications" wire:model="emailNotifications" />
        <flux:checkbox label="SMS notifications" wire:model="smsNotifications" />
    </div>
</flux:field>
```

## Reference

### Props

| Prop  | Description                                                        |
| ----- | ------------------------------------------------------------------ |
| badge | Optional text to display as a badge (e.g., "Required", "Optional") |
| for   | HTML for attribute to associate the label with a form control      |

### Slots

| Slot    | Description            |
| ------- | ---------------------- |
| default | The label text content |

### Attributes

| Attribute       | Description                                                |
| --------------- | ---------------------------------------------------------- |
| data-flux-label | Applied to the root element for styling and identification |

### CSS Features

- Consistent typography and spacing
- Dark mode support
- Badge styling and positioning
- Proper alignment with form controls
- Focus state indication

### Accessibility

- Proper HTML `<label>` element usage
- Automatic form control association
- Screen reader support
- ARIA attribute management
- Keyboard navigation support

### Best Practices

1. Always provide labels for form controls
2. Use clear and concise label text
3. Include badges when field requirements might be unclear
4. Maintain consistent labeling patterns
5. Consider using Field component for complex form layouts
6. Ensure proper association with form controls
7. Use descriptive text to provide additional context
8. Follow accessibility guidelines for form labeling 