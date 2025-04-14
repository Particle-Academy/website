# Textarea Component

The Textarea component provides a multi-line text input field, ideal for capturing longer text content such as comments, descriptions, and feedback from users.

## Basic Usage

```blade
<flux:textarea />
```

## With Label and Placeholder

Add a label and placeholder text to guide users:

```blade
<flux:textarea 
    label="Order notes" 
    placeholder="No lettuce, tomato, or onion..." 
/>
```

## Fixed Height

Control the height of the textarea using the `rows` prop:

```blade
<flux:textarea 
    rows="2" 
    label="Note" 
/>
```

## Auto-sizing Textarea

Enable automatic height adjustment based on content using `rows="auto"`:

```blade
<flux:textarea rows="auto" />
```

> **Note**: The auto-sizing feature uses CSS's `field-sizing` property, which may not be supported in all browsers. Check [caniuse.com](https://caniuse.com) for browser compatibility.

## Resize Controls

Control how users can resize the textarea using the `resize` prop:

```blade
<!-- Vertical resizing only (default) -->
<flux:textarea resize="vertical" />

<!-- No resizing -->
<flux:textarea resize="none" />

<!-- Horizontal resizing only -->
<flux:textarea resize="horizontal" />

<!-- Both directions -->
<flux:textarea resize="both" />
```

## Component Reference

### Props

| Prop                   | Type           | Default    | Description                                                |
| ---------------------- | -------------- | ---------- | ---------------------------------------------------------- |
| `wire:model`           | string         | -          | Livewire model binding                                     |
| `name`                 | string         | -          | Input name (auto-set with wire:model)                      |
| `placeholder`          | string         | -          | Placeholder text                                           |
| `label`                | string         | -          | Label text above textarea                                  |
| `description`          | string         | -          | Help text below label                                      |
| `description-trailing` | boolean        | false      | Show description below textarea                            |
| `badge`                | string         | -          | Badge text in label                                        |
| `rows`                 | string\|number | 4          | Number of visible lines or "auto"                          |
| `resize`               | string         | 'vertical' | Resize behavior ('vertical', 'horizontal', 'both', 'none') |
| `invalid`              | boolean        | false      | Apply error styling                                        |

### Attributes

| Attribute            | Description                                            |
| -------------------- | ------------------------------------------------------ |
| `data-flux-textarea` | Applied to textarea element for styling/identification |

## Field Wrapper

The textarea can be wrapped in a field component for more structured forms:

```blade
<flux:field>
    <flux:label>Comments</flux:label>
    <flux:description>Please provide any additional notes</flux:description>
    <flux:textarea />
    <flux:error name="comments" />
</flux:field>
```

## Best Practices

1. Input Length
   - Consider setting appropriate minimum/maximum lengths
   - Provide visual feedback on remaining characters if limited
   - Use appropriate number of initial rows

2. Validation
   - Clearly indicate required fields
   - Show validation errors inline
   - Provide helpful error messages

3. Usability
   - Include clear labels and placeholders
   - Consider auto-resize for better user experience
   - Maintain consistent styling with other form elements

4. Accessibility
   - Ensure proper label associations
   - Maintain keyboard navigation
   - Provide appropriate ARIA attributes

## CSS Customization

The Textarea component can be styled using CSS custom properties:

```css
.flux-textarea {
    /* Base styles */
    --textarea-min-height: 4rem;
    --textarea-padding: theme(spacing.2);
    
    /* Colors */
    --textarea-bg: theme(colors.white);
    --textarea-border: theme(colors.gray.200);
    --textarea-focus-ring: theme(colors.primary.100);
    
    /* Typography */
    --textarea-font-size: theme(fontSize.sm);
    --textarea-line-height: theme(lineHeight.normal);
    
    /* States */
    --textarea-disabled-bg: theme(colors.gray.50);
    --textarea-invalid-border: theme(colors.red.500);
}
``` 