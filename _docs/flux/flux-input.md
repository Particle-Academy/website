# Flux Input Component

A versatile input component for capturing user data with various forms of text input. The component provides rich functionality including labels, descriptions, validation, and special features like clearable and copyable inputs.

## Basic Usage

```blade
<flux:input 
    wire:model="username" 
    label="Username" 
    description="This will be publicly displayed."
/>
```

## Longhand Syntax

For more control over the layout, you can use the field components individually:

```blade
<flux:field>
    <flux:label>Username</flux:label>
    <flux:description>This will be publicly displayed.</flux:description>
    <flux:input />
    <flux:error name="username" />
</flux:field>
```

## Special Features

### Clearable, Copyable, and Viewable Inputs

```blade
<!-- Clearable input -->
<flux:input placeholder="Search orders" clearable />

<!-- Password input with visibility toggle -->
<flux:input type="password" value="password" viewable />

<!-- Readonly input with copy functionality -->
<flux:input 
    icon="key" 
    value="FLUX-1234-5678-ABCD-EFGH" 
    readonly 
    copyable
/>
```

### Keyboard Hints

Add keyboard shortcut hints:

```blade
<flux:input 
    kbd="⌘K" 
    icon="magnifying-glass" 
    placeholder="Search..."
/>
```

### Button Style Input

Render an input as a button:

```blade
<flux:input 
    as="button" 
    placeholder="Search..." 
    icon="magnifying-glass" 
    kbd="⌘K"
/>
```

## Input Groups

Attach buttons or other inputs:

```blade
<!-- With button -->
<flux:input.group>
    <flux:input placeholder="Post title" />
    <flux:button icon="plus">New post</flux:button>
</flux:input.group>

<!-- With select -->
<flux:input.group>
    <flux:select class="max-w-fit">
        <flux:select.option selected>USD</flux:select.option>
        <!-- Additional options -->
    </flux:select>
    <flux:input placeholder="$99.99" />
</flux:input.group>
```

## States

### Readonly

```blade
<flux:input readonly variant="filled" />
```

### Invalid

```blade
<flux:input invalid />
```

## Input Masking

Use Alpine's mask plugin for formatted input:

```blade
<flux:input mask="(999) 999-9999" value="7161234567" />
```

## Icons

Add icons to either end of the input:

```blade
<!-- Leading icon -->
<flux:input 
    icon="magnifying-glass" 
    placeholder="Search orders"
/>

<!-- Trailing icon -->
<flux:input 
    icon-trailing="credit-card" 
    placeholder="4444-4444-4444-4444"
/>

<!-- Loading state -->
<flux:input 
    icon-trailing="loading" 
    placeholder="Search transactions"
/>
```

## Icon Buttons

Add interactive buttons within the input:

```blade
<flux:input placeholder="Search orders">
    <x-slot name="iconTrailing">
        <flux:button 
            size="sm" 
            variant="subtle" 
            icon="x-mark" 
            class="-mr-1"
        />
    </x-slot>
</flux:input>
```

## Class Targeting

Target the input element directly using `class:input`:

```blade
<flux:input 
    class="max-w-xs" 
    class:input="font-mono"
/>
```

## Input Types

Support for various HTML input types:

```blade
<flux:input type="email" label="Email" />
<flux:input type="password" label="Password" />
<flux:input type="date" max="2999-12-31" label="Date" />
```

## File Input

Special component for file uploads:

```blade
<!-- Single file upload -->
<flux:input type="file" wire:model="logo" label="Logo"/>

<!-- Multiple file upload -->
<flux:input 
    type="file" 
    wire:model="attachments" 
    label="Attachments" 
    multiple
/>
```

## Size Variants

Compact size option:

```blade
<flux:input size="sm" placeholder="Filter by..." />
```

## Disabled State

```blade
<flux:input disabled label="Email" />
```

## Reference

### Props

| Prop          | Description                                     |
| ------------- | ----------------------------------------------- |
| type          | Input type (text, email, password, file, etc.)  |
| label         | Input label text                                |
| description   | Helper text below the input                     |
| placeholder   | Placeholder text                                |
| wire:model    | Livewire model binding                          |
| size          | Size variant: "default", "sm"                   |
| variant       | Visual style variant: "default", "filled"       |
| invalid       | Whether the input is in an error state          |
| disabled      | Whether the input is disabled                   |
| readonly      | Whether the input is read-only                  |
| required      | Whether the input is required                   |
| clearable     | Whether to show a clear button                  |
| copyable      | Whether to show a copy button                   |
| viewable      | Whether to show a password visibility toggle    |
| mask          | Input mask pattern                              |
| icon          | Leading icon name                               |
| icon-trailing | Trailing icon name                              |
| kbd           | Keyboard shortcut hint                          |
| as            | Render as different element ("input", "button") |

### Slots

| Slot         | Description                  |
| ------------ | ---------------------------- |
| iconLeading  | Custom leading icon content  |
| iconTrailing | Custom trailing icon content |

### CSS Features

- Consistent styling across variants
- Dark mode support
- Focus and hover states
- Error state styling
- Icon positioning and spacing
- Input masking support

### Accessibility

- Proper label associations
- ARIA attributes for states
- Keyboard navigation support
- Screen reader announcements for errors
- Focus management

### Best Practices

1. Use appropriate input types for data validation
2. Provide clear labels and descriptions
3. Use placeholder text sparingly
4. Include validation feedback
5. Consider mobile usability
6. Use masking for formatted input
7. Implement proper error handling
8. Consider keyboard shortcuts for common actions 