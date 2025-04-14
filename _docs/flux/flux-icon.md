# Flux Icon Component

Flux uses the Heroicons library for its icon collection, providing beautiful and functional icons crafted by Tailwind Labs. The Icon component offers various styles, sizes, and customization options.

## Basic Usage

```blade
<flux:icon.bolt />
```

## Variants

Four variants are available for each icon:

```blade
<flux:icon.bolt />                  <!-- 24px, outline (default) -->
<flux:icon.bolt variant="solid" />  <!-- 24px, filled -->
<flux:icon.bolt variant="mini" />   <!-- 20px, filled -->
<flux:icon.bolt variant="micro" />  <!-- 16px, filled -->
```

## Sizes

Control icon size using Tailwind's size utilities. However, it's recommended to use the default sizes as each variant is specifically designed for its intended size.

```blade
<flux:icon.bolt class="size-12" />
<flux:icon.bolt class="size-10" />
<flux:icon.bolt class="size-8" />
```

## Colors

Customize icon colors using Tailwind's text color utilities:

```blade
<flux:icon.bolt 
    variant="solid" 
    class="text-amber-500 dark:text-amber-300"
/>
```

## Loading Spinner

Flux provides a special loading spinner icon that isn't part of the Heroicons collection:

```blade
<flux:icon.loading />
```

## Lucide Icons

For a broader icon selection, Flux supports Lucide icons. Import them using the artisan command:

```bash
# Import specific icons
php artisan flux:icon crown grip-vertical github

# Or use the interactive prompt
php artisan flux:icon
```

Usage:
```blade
<flux:icon.crown />
<flux:icon.grip-vertical />
<flux:icon.github />
```

## Custom Icons

Create custom icons by adding Blade files in the `resources/views/flux/icon` directory:

```php
// resources/views/flux/icon/wink.blade.php

@php
$attributes = $unescapedForwardedAttributes ?? $attributes;
@endphp

@props([
    'variant' => 'outline',
])

@php
$classes = Flux::classes('shrink-0')
    ->add(match($variant) {
        'outline' => '[:where(&)]:size-6',
        'solid' => '[:where(&)]:size-6',
        'mini' => '[:where(&)]:size-5',
        'micro' => '[:where(&)]:size-4',
    });
@endphp

<svg 
    {{ $attributes->class($classes) }} 
    data-flux-icon 
    aria-hidden="true"
    ...
>
    <!-- Your SVG code here -->
</svg>
```

Usage:
```blade
<flux:icon.wink />
```

## Reference

### Props

| Prop    | Description                                                       |
| ------- | ----------------------------------------------------------------- |
| variant | Icon style variant: "outline" (default), "solid", "mini", "micro" |

### Attributes

| Attribute      | Description                                                |
| -------------- | ---------------------------------------------------------- |
| data-flux-icon | Applied to the root element for styling and identification |
| class          | Additional CSS classes for customization                   |

### CSS Features

- Consistent sizing across variants
- Color customization through Tailwind utilities
- Dark mode support
- Automatic sizing based on variant

### Accessibility

- Proper ARIA attributes
- Screen reader support
- Semantic SVG structure

### Best Practices

1. Use appropriate variants for their intended sizes:
   - Outline/Solid (24px) for primary actions and navigation
   - Mini (20px) for secondary actions and compact UIs
   - Micro (16px) for dense information displays
2. Maintain consistent icon usage across your application
3. Ensure sufficient color contrast for visibility
4. Consider using the loading spinner for async operations
5. Use Lucide icons when Heroicons doesn't provide the needed icon
6. Follow the template structure when creating custom icons 