# Flux Button Component

A powerful and composable button component for your application.

## Basic Usage

```blade
<flux:button>Button</flux:button>
```

## Variants

Use the variant prop to change the visual style of the button:

```blade
<flux:button>Default</flux:button>
<flux:button variant="primary">Primary</flux:button>
<flux:button variant="filled">Filled</flux:button>
<flux:button variant="danger">Danger</flux:button>
<flux:button variant="ghost">Ghost</flux:button>
<flux:button variant="subtle">Subtle</flux:button>
```

Note: Use primary buttons sparingly; mostly for form submissions.

## Sizes

Choose from different size options:

```blade
<flux:button>Default</flux:button>
<flux:button size="sm">Small</flux:button>
<flux:button size="xs">Extra small</flux:button>
```

## With Icons

Add icons to your buttons:

```blade
<flux:button icon="ellipsis-horizontal" />
<flux:button icon="arrow-down-tray">Export</flux:button>
<flux:button icon-trailing="chevron-down">Open</flux:button>
<flux:button icon="x-mark" variant="subtle" />
```

## Loading State

Buttons with `wire:click` or `type="submit"` automatically show a loading indicator:

```blade
<flux:button wire:click="save">
    Save changes
</flux:button>

<!-- Disable loading state -->
<flux:button wire:click="save" :loading="false">
    Save changes
</flux:button>
```

## Button Groups

### Standard Group
Group related buttons together:

```blade
<flux:button.group>
    <flux:button>Oldest</flux:button>
    <flux:button>Newest</flux:button>
    <flux:button>Top</flux:button>
</flux:button.group>
```

### Attached Buttons
Append or prepend an icon button:

```blade
<flux:button.group>
    <flux:button>New product</flux:button>
    <flux:button icon="chevron-down"></flux:button>
</flux:button.group>
```

### Icon Group
Create a visually-linked group of icon buttons:

```blade
<flux:button.group>
    <flux:button icon="bars-3-bottom-left"></flux:button>
    <flux:button icon="bars-3"></flux:button>
    <flux:button icon="bars-3-bottom-right"></flux:button>
</flux:button.group>
```

## Special Variants

### As Link
Use a button as a link by providing an href:

```blade
<flux:button href="https://google.com" icon-trailing="arrow-up-right">
    Visit Google
</flux:button>
```

### Square Button
Make height and width equal (automatic for icon-only buttons):

```blade
<flux:button square>...</flux:button>
```

### Full Width
Span the entire container width:

```blade
<flux:button variant="primary" class="w-full">Send invite</flux:button>
```

### Inset Button
For better alignment with ghost or subtle variants:

```blade
<div class="flex justify-between">
    <flux:heading>Post successfully created.</flux:heading>
    <flux:button size="sm" icon="x-mark" variant="ghost" inset />
</div>
```

## Reference

### flux:button

| Prop | Description |
|------|-------------|
| variant | Button style: "default", "primary", "filled", "danger", "ghost", "subtle" |
| size | Button size: "xs", "sm", or default |
| icon | Icon to display at the start of the button |
| icon-trailing | Icon to display at the end of the button |
| href | Convert button to an anchor tag with this URL |
| square | Make height and width equal |
| inset | Add negative margins for better alignment |
| loading | Control loading state visibility |
| disabled | Disable button interaction |

### flux:button.group

A wrapper component to group related buttons together with shared borders.
``` 