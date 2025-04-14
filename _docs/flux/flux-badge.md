# Flux Badge Component

Highlight information like status, category, or count with customizable badges.

## Basic Usage

```blade
<flux:badge color="lime">New</flux:badge>
```

## Variants

### Sizes

Choose between three different sizes:

```blade
<flux:badge size="sm">Small</flux:badge>
<flux:badge>Default</flux:badge>
<flux:badge size="lg">Large</flux:badge>
```

### With Icons

Add icons to the start or end of badges:

```blade
<flux:badge icon="user-circle">Users</flux:badge>
<flux:badge icon="document-text">Files</flux:badge>
<flux:badge icon-trailing="video-camera">Videos</flux:badge>
```

### Pill Variant

Display badges with fully rounded borders:

```blade
<flux:badge variant="pill" icon="user">Users</flux:badge>
```

### Solid Variant

Bold, high-contrast badges for important status indicators:

```blade
<flux:badge variant="solid" color="green">Active</flux:badge>
```

### As Button

Make the entire badge clickable:

```blade
<flux:badge as="button" variant="pill" icon="plus" size="lg">Amount</flux:badge>
```

### With Close Button

Make a badge removable:

```blade
<flux:badge>
    Admin
    <flux:badge.close />
</flux:badge>
```

### Inset Badge

Use negative margins to align with text:

```blade
<flux:heading>
    Page builder
    <flux:badge color="lime" inset="top bottom">New</flux:badge>
</flux:heading>
```

## Colors

Available colors include:

```blade
<flux:badge color="zinc">Zinc</flux:badge>
<flux:badge color="red">Red</flux:badge>
<flux:badge color="orange">Orange</flux:badge>
<flux:badge color="amber">Amber</flux:badge>
<flux:badge color="yellow">Yellow</flux:badge>
<flux:badge color="lime">Lime</flux:badge>
<flux:badge color="green">Green</flux:badge>
<flux:badge color="emerald">Emerald</flux:badge>
<flux:badge color="teal">Teal</flux:badge>
<flux:badge color="cyan">Cyan</flux:badge>
<flux:badge color="sky">Sky</flux:badge>
<flux:badge color="blue">Blue</flux:badge>
<flux:badge color="indigo">Indigo</flux:badge>
<flux:badge color="violet">Violet</flux:badge>
<flux:badge color="purple">Purple</flux:badge>
<flux:badge color="fuchsia">Fuchsia</flux:badge>
<flux:badge color="pink">Pink</flux:badge>
<flux:badge color="rose">Rose</flux:badge>
```

## Example Use Cases

### Status Indicators
```blade
<flux:badge color="green" variant="solid">Active</flux:badge>
<flux:badge color="yellow">Pending</flux:badge>
<flux:badge color="red" variant="solid">Failed</flux:badge>
```

### Notification Counts
```blade
<flux:badge color="blue" variant="pill">5</flux:badge>
```

### Feature Tags
```blade
<flux:badge color="purple" icon="sparkles">Pro</flux:badge>
```

## Reference

### flux:badge

| Prop | Description |
|------|-------------|
| color | The color of the badge (see Colors section for options) |
| size | Size of the badge: "sm", "default", or "lg" |
| variant | Visual style: "default", "solid", or "pill" |
| icon | Icon to display at the start of the badge |
| icon-trailing | Icon to display at the end of the badge |
| as | Render as a different element (e.g., "button") |
| inset | Add negative margins: "top", "bottom", "left", "right" |

### flux:badge.close

A button component that can be used inside a badge to make it dismissible. 