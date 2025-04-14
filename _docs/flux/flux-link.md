# Flux Link Component

A versatile link component for navigation and actions that provides consistent styling and accessibility features. The Link component can be used for both internal and external links, with various visual styles and states.

## Basic Usage

```blade
<flux:link href="/dashboard">Dashboard</flux:link>
```

## Variants

### Default Link

```blade
<flux:link href="/settings">Settings</flux:link>
```

### Button Style Link

```blade
<flux:link href="/signup" variant="button">
    Create account
</flux:link>
```

### Subtle Link

```blade
<flux:link href="/terms" variant="subtle">
    Terms of Service
</flux:link>
```

## With Icons

Add icons to enhance visual context:

```blade
<!-- Leading icon -->
<flux:link href="/settings" icon="cog">
    Settings
</flux:link>

<!-- Trailing icon -->
<flux:link href="/docs" icon-trailing="arrow-right">
    Documentation
</flux:link>
```

## External Links

Links to external sites automatically add appropriate attributes:

```blade
<flux:link 
    href="https://example.com" 
    external
>
    Visit external site
</flux:link>
```

## States

### Active State

```blade
<flux:link 
    href="/current-page" 
    active
>
    Current page
</flux:link>
```

### Disabled State

```blade
<flux:link 
    href="/unavailable" 
    disabled
>
    Unavailable link
</flux:link>
```

## Size Variants

```blade
<!-- Default size -->
<flux:link href="/default">Default size</flux:link>

<!-- Small size -->
<flux:link href="/small" size="sm">Small size</flux:link>
```

## Navigation Links

Use with Laravel's routing system:

```blade
<flux:link 
    href="{{ route('dashboard') }}" 
    :active="request()->routeIs('dashboard')"
>
    Dashboard
</flux:link>
```

## Reference

### Props

| Prop          | Description                                         |
| ------------- | --------------------------------------------------- |
| href          | The URL the link points to                          |
| variant       | Visual style variant: "default", "button", "subtle" |
| size          | Size variant: "default", "sm"                       |
| external      | Whether the link points to an external site         |
| active        | Whether the link represents the current page/state  |
| disabled      | Whether the link is disabled                        |
| icon          | Name of the leading icon                            |
| icon-trailing | Name of the trailing icon                           |

### Slots

| Slot    | Description           |
| ------- | --------------------- |
| default | The link text content |

### Attributes

| Attribute      | Description                                                |
| -------------- | ---------------------------------------------------------- |
| data-flux-link | Applied to the root element for styling and identification |

### CSS Features

- Consistent typography and spacing
- Hover and focus states
- Active state styling
- Dark mode support
- Icon alignment and spacing
- Disabled state visual feedback

### Accessibility

- Proper use of HTML anchor elements
- ARIA attributes for states
- Keyboard focus management
- Screen reader announcements
- External link indicators
- Skip navigation support

### Best Practices

1. Use descriptive link text
2. Indicate external links appropriately
3. Maintain consistent styling across the application
4. Use active states for current pages/sections
5. Include hover and focus states for interaction feedback
6. Consider mobile touch targets
7. Add icons to enhance visual context
8. Follow accessibility guidelines for navigation
9. Use appropriate variants for different contexts
10. Implement proper routing integration 