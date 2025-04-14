# Toast Component

The Toast component provides a way to display temporary, non-disruptive notifications to users. It's perfect for showing feedback about operations, such as successful saves, warnings, or error messages.

## Basic Usage

To use the Toast component, you must first include it in your layout file:

```blade
<flux:toast />
```

For applications using `wire:navigate`, you can persist the toast across page navigations:

```blade
@persist('toast')
<flux:toast />
@endpersist
```

## Triggering Toasts

### From Livewire Components

```php
use Flux;

class EditPost extends \Livewire\Component
{
    public function save()
    {
        // ... save logic ...
        Flux::toast('Your changes have been saved.');
    }
}
```

### From Alpine.js

```html
<button x-on:click="$flux.toast('Your changes have been saved.')">
    Save changes
</button>
```

### From JavaScript

```javascript
let button = document.querySelector('...')
button.addEventListener('click', () => {
    Flux.toast('Your changes have been saved.')
})
```

## Features

### With Heading

You can add a heading to provide additional context:

```php
Flux::toast([
    'heading' => 'Changes saved',
    'text' => 'You can always update this in your settings.'
]);
```

### Variants

The Toast component supports different variants to convey different types of messages:

```php
// Success message
Flux::toast('Operation completed successfully', variant: 'success');

// Warning message
Flux::toast('Please review your input', variant: 'warning');

// Error message
Flux::toast('Something went wrong', variant: 'danger');
```

### Positioning

By default, toasts appear in the bottom right corner. You can customize the position:

```blade
<flux:toast position="top right" />

<!-- With extra padding for navbars -->
<flux:toast position="top right" class="pt-24" />
```

### Duration Control

Control how long the toast remains visible:

```php
// Show for 1 second
Flux::toast('Quick message', duration: 1000);

// Show indefinitely
Flux::toast('Important message', duration: 0);
```

## Advanced Configuration

### Toast Method Parameters

The `toast()` method accepts the following parameters:

```php
Flux::toast([
    'heading' => 'Optional heading',
    'text' => 'Toast message',
    'variant' => 'success|warning|danger', // Optional
    'duration' => 5000, // Optional, defaults to 5000ms
]);
```

### Animation Behavior

- Toasts positioned at the top will slide in from the side
- Toasts positioned at the bottom will slide up from the bottom
- Enhanced drop-shadow for better visibility in the foreground
- Optimized slide-up animation duration for better user attention

## Best Practices

1. **Keep Messages Concise**: Toast messages should be brief and to the point
2. **Use Appropriate Variants**: Choose the right variant to match the message context
3. **Consider Duration**: Set appropriate durations based on message importance
4. **Position Carefully**: Consider the layout of your application when choosing toast positions
5. **Accessibility**: Ensure toast messages are accessible and don't interfere with user interaction

## CSS Customization

The Toast component can be styled using Tailwind CSS classes:

```blade
<flux:toast class="my-custom-class" />
```

## Browser Support

The Toast component is supported across all modern browsers and includes fallbacks for older browsers. 