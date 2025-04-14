# Flux Field Component

A container component that encapsulates form input elements with labels, descriptions, and validation messages. The Field component provides a consistent structure for form controls while handling common patterns like labels, help text, and error states.

## Basic Usage

The basic field component wraps form controls with labels and error handling:

```blade
<flux:field>
    <flux:label>Email</flux:label>
    <flux:input wire:model="email" type="email" />
    <flux:error name="email" />
</flux:field>
```

## Shorthand Syntax

For simpler use cases, form controls in Flux allow passing label and description directly as props:

```blade
<flux:input 
    wire:model="email" 
    label="Email" 
    type="email"
/>
```

## With Trailing Description

Position descriptive text below the input field:

```blade
<flux:field>
    <flux:label>Password</flux:label>
    <flux:input type="password" />
    <flux:error name="password" />
    <flux:description>
        Must be at least 8 characters long, include an uppercase letter, a number, and a special character.
    </flux:description>
</flux:field>

<!-- Alternative shorthand syntax -->
<flux:input 
    type="password" 
    label="Password" 
    description-trailing="Must be at least 8 characters long, include an uppercase letter, a number, and a special character."
/>
```

## With Badge

Add badges to indicate field requirements:

```blade
<flux:field>
    <flux:label badge="Required">Email</flux:label>
    <flux:input type="email" required />
    <flux:error name="email" />
</flux:field>

<flux:field>
    <flux:label badge="Optional">Phone number</flux:label>
    <flux:input 
        type="phone" 
        placeholder="(555) 555-5555" 
        mask="(999) 999-9999"
    />
    <flux:error name="phone" />
</flux:field>
```

## Split Layout

Display multiple fields horizontally:

```blade
<div class="grid grid-cols-2 gap-4">
    <flux:input label="First name" placeholder="River" />
    <flux:input label="Last name" placeholder="Porzio" />
</div>
```

## Fieldset Groups

Group related fields using fieldset and legend components:

```blade
<flux:fieldset>
    <flux:legend>Shipping address</flux:legend>
    <div class="space-y-6">
        <flux:input 
            label="Street address line 1" 
            placeholder="123 Main St" 
            class="max-w-sm"
        />
        <flux:input 
            label="Street address line 2" 
            placeholder="Apartment, studio, or floor" 
            class="max-w-sm"
        />
        <div class="grid grid-cols-2 gap-x-4 gap-y-6">
            <flux:input label="City" placeholder="San Francisco" />
            <flux:input label="State / Province" placeholder="CA" />
            <flux:input label="Postal / Zip code" placeholder="12345" />
            <flux:select label="Country">
                <option selected>United States</option>
                <!-- Additional options -->
            </flux:select>
        </div>
    </div>
</flux:fieldset>
```

## Reference

### flux:field

| Prop    | Description                                                   |
| ------- | ------------------------------------------------------------- |
| variant | Visual style variant. Options: block, inline. Default: block. |

| Slot    | Description                                                                                                    |
| ------- | -------------------------------------------------------------------------------------------------------------- |
| default | The form control elements (input, select, etc.) and their associated labels, descriptions, and error messages. |

| Attribute       | Description                                                 |
| --------------- | ----------------------------------------------------------- |
| data-flux-field | Applied to the root element for styling and identification. |

### flux:label

| Prop  | Description                                                         |
| ----- | ------------------------------------------------------------------- |
| badge | Optional text to display as a badge (e.g., "Required", "Optional"). |

| Slot    | Description             |
| ------- | ----------------------- |
| default | The label text content. |

### flux:description

| Slot    | Description                   |
| ------- | ----------------------------- |
| default | The descriptive text content. |

### flux:error

| Prop    | Description                                             |
| ------- | ------------------------------------------------------- |
| name    | The name of the field to display validation errors for. |
| message | Custom error message content (optional).                |

| Slot    | Description                              |
| ------- | ---------------------------------------- |
| default | Custom error message content (optional). |

### flux:fieldset

| Prop        | Description                                 |
| ----------- | ------------------------------------------- |
| legend      | The fieldset's heading text.                |
| description | Optional description text for the fieldset. |

| Slot    | Description                                          |
| ------- | ---------------------------------------------------- |
| default | The grouped form fields and their associated legend. |

### flux:legend

| Slot    | Description                  |
| ------- | ---------------------------- |
| default | The fieldset's heading text. |

### Accessibility

- Labels are properly associated with their form controls
- Error messages are announced by screen readers
- Fieldsets provide semantic grouping of related form fields
- Required and optional states are clearly indicated 