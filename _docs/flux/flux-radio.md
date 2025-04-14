# Flux Radio Component

A radio component for selecting a single option from a set of mutually exclusive choices. Perfect for single-choice questions, settings, and form inputs that require one selection from multiple options.

## Basic Usage

```blade
<flux:radio.group wire:model="payment" label="Select your payment method">
    <flux:radio value="cc" label="Credit Card" checked />
    <flux:radio value="paypal" label="Paypal" />
    <flux:radio value="ach" label="Bank transfer" />
</flux:radio.group>
```

## With Descriptions

Add descriptions to provide more context for each option:

```blade
<flux:fieldset>
    <flux:legend>Role</flux:legend>
    <flux:radio.group>
        <flux:radio 
            value="administrator" 
            label="Administrator" 
            description="Administrator users can perform any action." 
            checked 
        />
        <flux:radio 
            value="editor" 
            label="Editor" 
            description="Editor users have the ability to read, create, and update." 
        />
        <flux:radio 
            value="viewer" 
            label="Viewer" 
            description="Viewer users only have the ability to read." 
        />
    </flux:radio.group>
</flux:fieldset>
```

## Segmented Variant

A more compact alternative to standard radio buttons:

```blade
<flux:radio.group 
    wire:model="role" 
    label="Role" 
    variant="segmented"
>
    <flux:radio label="Admin" />
    <flux:radio label="Editor" />
    <flux:radio label="Viewer" />
</flux:radio.group>

<!-- Small size -->
<flux:radio.group 
    wire:model="role" 
    label="Role" 
    variant="segmented" 
    size="sm"
>
    <flux:radio label="Admin" />
    <flux:radio label="Editor" />
    <flux:radio label="Viewer" />
</flux:radio.group>
```

## With Icons

Add icons to radio options (for segmented variant):

```blade
<flux:radio.group 
    wire:model="align" 
    label="Text alignment" 
    variant="segmented"
>
    <flux:radio icon="align-left" label="Left" />
    <flux:radio icon="align-center" label="Center" />
    <flux:radio icon="align-right" label="Right" />
</flux:radio.group>
```

## Invalid State

Display validation errors:

```blade
<flux:radio.group 
    wire:model="role" 
    label="Role" 
    invalid
>
    <flux:radio value="admin" label="Admin" />
    <flux:radio value="user" label="User" />
</flux:radio.group>
```

## Reference

### flux:radio.group Props

| Prop        | Description                                                   |
| ----------- | ------------------------------------------------------------- |
| wire:model  | Binds the radio group selection to a Livewire property        |
| name        | Name attribute for the radio group (auto-set with wire:model) |
| label       | Label text displayed above the radio group                    |
| description | Help text displayed below the radio group                     |
| variant     | Visual style: "default", "segmented", "cards"                 |
| invalid     | Whether to apply error styling                                |
| size        | Size variant for segmented style: "default", "sm"             |

### flux:radio Props

| Prop        | Description                                   |
| ----------- | --------------------------------------------- |
| label       | Label text for the radio option               |
| description | Help text displayed below the radio option    |
| value       | Value associated with the radio when selected |
| checked     | Whether the radio is selected by default      |
| disabled    | Whether the radio is disabled                 |
| icon        | Icon name (for segmented variant)             |

### Slots

#### flux:radio.group

| Slot    | Description                              |
| ------- | ---------------------------------------- |
| default | The radio buttons to be grouped together |

#### flux:radio

| Slot    | Description                     |
| ------- | ------------------------------- |
| default | Custom content for card variant |

### Attributes

| Attribute             | Description                       |
| --------------------- | --------------------------------- |
| data-flux-radio-group | Applied to the group root element |
| data-flux-radio       | Applied to the radio root element |
| data-checked          | Applied when a radio is selected  |

### CSS Features

- Consistent styling across variants
- Dark mode support
- Focus and hover states
- Error state styling
- Icon alignment and spacing
- Custom radio button styles
- Segmented variant styling

### Accessibility

- Proper ARIA roles and attributes
- Keyboard navigation support
- Focus management
- Screen reader announcements
- Form integration
- Error state announcements

### Best Practices

1. Use clear and concise labels
2. Provide descriptive help text when needed
3. Group related options together
4. Use appropriate variants for context
5. Implement proper form validation
6. Consider mobile touch targets
7. Maintain consistent styling
8. Follow accessibility guidelines
9. Use icons to enhance visual context
10. Consider keyboard navigation 