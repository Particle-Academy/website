# Flux Heading Component

A consistent heading and subheading component for your application. The Heading component provides standardized text headings with various size options and semantic HTML structure.

## Basic Usage

```blade
<flux:heading>User profile</flux:heading>
<flux:subheading>This information will be displayed publicly.</flux:subheading>
```

## Sizes

The Heading component offers three different sizes to cover most use cases:

```blade
<!-- Default (14px) - Use liberally for input and toast labels -->
<flux:heading>Default</flux:heading>

<!-- Large (16px) - Use sparingly for modal and card headings -->
<flux:heading size="lg">Large</flux:heading>

<!-- Extra large (24px) - Use rarely for hero text -->
<flux:heading size="xl">Extra large</flux:heading>
```

## Heading Level

Control the semantic HTML heading level (h1-h6) using the `level` prop. Without a level prop, the heading will default to a div:

```blade
<flux:heading level="3">User profile</flux:heading>
<flux:subheading>This information will be displayed publicly.</flux:subheading>
```

## Leading Subheading

Subheadings can be placed above headings for a more interesting arrangement:

```blade
<div>
    <flux:subheading>Year to date</flux:subheading>
    <flux:heading size="xl" class="mb-1">$7,532.16</flux:heading>
    <div class="flex items-center gap-2">
        <flux:icon.arrow-trending-up 
            variant="micro" 
            class="text-green-600 dark:text-green-500"
        />
        <span class="text-sm text-green-600 dark:text-green-500">15.2%</span>
    </div>
</div>
```

## Automatic Spacing

The Heading component automatically handles spacing between headings and subheadings using CSS `:has()` selector:

```blade
<!-- These components will have appropriate spacing between them -->
<flux:heading>Welcome</flux:heading>
<flux:subheading>Log into your account</flux:subheading>
```

## Form Context Example

Example of using headings in a form context:

```blade
<form wire:submit="createAccount">
    <div class="mb-6">
        <flux:heading>Create an account</flux:heading>
        <flux:subheading>We're excited to have you on board.</flux:subheading>
    </div>
    
    <!-- Form fields -->
    <flux:input class="mb-6" label="Email" wire:model="email" />
    
    <div class="mb-6 flex *:w-1/2 gap-4">
        <flux:input label="Password" wire:model="password" />
        <flux:input 
            label="Confirm password" 
            wire:model="password_confirmation"
        />
    </div>
    
    <flux:button type="submit" variant="primary">
        Create account
    </flux:button>
</form>
```

## Reference

### flux:heading

| Prop  | Description                                                                  |
| ----- | ---------------------------------------------------------------------------- |
| size  | Size variant: "default" (14px), "lg" (16px), "xl" (24px). Default: "default" |
| level | HTML heading level (1-6). Renders as div if omitted                          |

| Slot    | Description              |
| ------- | ------------------------ |
| default | The heading text content |

| Attribute         | Description                                                |
| ----------------- | ---------------------------------------------------------- |
| data-flux-heading | Applied to the root element for styling and identification |

### flux:subheading

| Slot    | Description                 |
| ------- | --------------------------- |
| default | The subheading text content |

| Attribute            | Description                                                |
| -------------------- | ---------------------------------------------------------- |
| data-flux-subheading | Applied to the root element for styling and identification |

### CSS Features

- Automatic margin (mb-2) between heading and subheading using `:has()` selector
- Consistent typography scaling across size variants
- Dark mode support
- Responsive text sizing

### Accessibility

- Proper heading hierarchy when using the `level` prop
- Semantic HTML structure
- Consistent text contrast ratios
- Screen reader friendly heading structure

### Best Practices

1. Use appropriate heading levels for document structure
2. Choose size variants based on visual hierarchy:
   - Default (14px) for general labels and small headings
   - Large (16px) for section and component headings
   - Extra large (24px) for page titles and hero sections
3. Pair with subheadings to provide additional context
4. Maintain consistent heading hierarchy throughout your application 