# Tooltip Component

A component that displays additional information when users hover over or focus on an element. Tooltips are perfect for providing context without cluttering the interface.

> **Note**: Since tooltips rely on hover states, they may not be visible on touch devices. Essential information should be conveyed through the UI rather than tooltips for mobile users.

## Basic Usage

```blade
<flux:tooltip content="Settings">
    <flux:button icon="cog-6-tooth" icon-variant="outline" />
</flux:tooltip>
```

### Shorthand Syntax

For buttons, you can use the `tooltip` prop directly:

```blade
<flux:button 
    tooltip="Settings" 
    icon="cog-6-tooth" 
    icon-variant="outline" 
/>
```

## Positioning

Control tooltip placement using the `position` prop:

```blade
<!-- Top (default) -->
<flux:tooltip content="Settings" position="top">
    <flux:button icon="cog-6-tooth" />
</flux:tooltip>

<!-- Right -->
<flux:tooltip content="Settings" position="right">
    <flux:button icon="cog-6-tooth" />
</flux:tooltip>

<!-- Bottom -->
<flux:tooltip content="Settings" position="bottom">
    <flux:button icon="cog-6-tooth" />
</flux:tooltip>

<!-- Left -->
<flux:tooltip content="Settings" position="left">
    <flux:button icon="cog-6-tooth" />
</flux:tooltip>
```

## Rich Content

For more complex tooltips, use the content component:

```blade
<flux:tooltip>
    <flux:button icon="information-circle" />
    <flux:tooltip.content class="max-w-[20rem] space-y-2">
        <p>First line of detailed information.</p>
        <p>Second line with additional context.</p>
    </flux:tooltip.content>
</flux:tooltip>
```

## Interactive Tooltips

For essential information or touch devices, make tooltips clickable:

```blade
<flux:heading class="flex items-center gap-2">
    Tax ID
    <flux:tooltip toggleable>
        <flux:button 
            icon="information-circle" 
            size="sm" 
            variant="ghost" 
        />
        <flux:tooltip.content class="max-w-[20rem] space-y-2">
            <p>For US businesses: Enter your 9-digit EIN without hyphens.</p>
            <p>For EU companies: Enter VAT number with country prefix (e.g., DE123456789).</p>
        </flux:tooltip.content>
    </flux:tooltip>
</flux:heading>
```

## Component Reference

### Props

#### flux:tooltip
| Prop        | Type    | Default  | Description                                                |
| ----------- | ------- | -------- | ---------------------------------------------------------- |
| content     | string  | -        | Text content to display (alternative to content component) |
| position    | string  | 'top'    | Tooltip position ('top', 'right', 'bottom', 'left')        |
| align       | string  | 'center' | Alignment ('center', 'start', 'end')                       |
| gap         | number  | 5        | Space between trigger and tooltip (px)                     |
| offset      | number  | 0        | Offset from trigger element (px)                           |
| toggleable  | boolean | false    | Makes tooltip clickable instead of hover-only              |
| interactive | boolean | false    | Enables ARIA attributes for interactive content            |
| kbd         | string  | -        | Keyboard shortcut hint                                     |

#### flux:tooltip.content
| Prop | Type   | Description                    |
| ---- | ------ | ------------------------------ |
| kbd  | string | Keyboard shortcut hint to show |

### Attributes

| Attribute         | Description                                            |
| ----------------- | ------------------------------------------------------ |
| data-flux-tooltip | Applied to root element for styling and identification |

## Accessibility

1. **Keyboard Support**
   - Tooltips appear on both hover and keyboard focus
   - Proper ARIA attributes for screen readers
   - Keyboard shortcuts can be displayed using the `kbd` prop

2. **Best Practices**
   - Don't put essential information in tooltips
   - Avoid interactive elements inside tooltips
   - Don't use tooltips on disabled elements
   - Keep content brief and informative

## CSS Customization

Tooltips can be styled using Tailwind classes:

```blade
<flux:tooltip class="your-custom-classes">
    <!-- Content -->
</flux:tooltip>
```

## Browser Support

The Tooltip component is supported across all modern browsers with appropriate fallbacks for older browsers. 