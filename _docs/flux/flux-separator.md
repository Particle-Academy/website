# Separator Component

A visual divider that separates content into distinct sections, providing clear visual hierarchy and organization in your layouts.

## Basic Usage

```blade
<flux:separator />
```

## Features

### Orientation

The separator can be oriented horizontally or vertically:

```blade
<!-- Horizontal (default) -->
<flux:separator />

<!-- Vertical -->
<flux:separator orientation="vertical" />
```

### Variants

Different visual styles for different contexts:

```blade
<!-- Default -->
<flux:separator />

<!-- Subtle -->
<flux:separator variant="subtle" />

<!-- Dashed -->
<flux:separator variant="dashed" />
```

### With Content

Add text or other content within the separator:

```blade
<flux:separator>
    <span>Or continue with</span>
</flux:separator>
```

### In Lists or Menus

Use separators to group menu items or list content:

```blade
<flux:menu>
    <flux:menu.item>Profile</flux:menu.item>
    <flux:menu.item>Settings</flux:menu.item>
    <flux:separator />
    <flux:menu.item variant="danger">Logout</flux:menu.item>
</flux:menu>
```

## Component Reference

### flux:separator

The main separator component.

#### Props
| Prop        | Type   | Default      | Description                                                 |
| ----------- | ------ | ------------ | ----------------------------------------------------------- |
| orientation | string | 'horizontal' | The orientation of the separator ('horizontal', 'vertical') |
| variant     | string | 'default'    | Visual style variant ('default', 'subtle', 'dashed')        |

#### Slots
| Slot    | Description                                           |
| ------- | ----------------------------------------------------- |
| default | Optional content to display centered in the separator |

#### Attributes
| Attribute           | Description                                                |
| ------------------- | ---------------------------------------------------------- |
| data-flux-separator | Applied to the root element for styling and identification |
| data-orientation    | The current orientation of the separator                   |

## Accessibility

1. **Semantic Markup**
   - Uses appropriate ARIA role="separator"
   - Maintains proper document structure
   - Preserves content flow for screen readers

2. **Visual Clarity**
   - Provides sufficient contrast for visibility
   - Maintains consistent spacing
   - Scales appropriately with text size

## Best Practices

1. **Usage Guidelines**
   - Use separators to create clear visual boundaries
   - Avoid overusing separators which can lead to visual clutter
   - Consider using subtle variants for less prominent divisions

2. **Spacing**
   - Maintain consistent spacing around separators
   - Adjust margins based on content density
   - Consider responsive layouts when using vertical separators

3. **Content Organization**
   - Use separators to group related content
   - Consider alternative methods for content division when appropriate
   - Maintain logical content hierarchy

## CSS Customization

The separator can be styled using Tailwind CSS classes:

```blade
<flux:separator class="my-custom-classes">
    <!-- Optional content -->
</flux:separator>
```

### Custom Styling Examples

```blade
<!-- Custom color -->
<flux:separator class="border-blue-500" />

<!-- Custom spacing -->
<flux:separator class="my-8" />

<!-- Custom width for vertical separator -->
<flux:separator orientation="vertical" class="mx-4 h-full" />
```

## Browser Support

The Separator component is supported across all modern browsers with appropriate fallbacks for older browsers. 