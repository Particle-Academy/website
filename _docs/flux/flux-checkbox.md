# Flux Checkbox Component

Select one or multiple options from a set of choices.

## Basic Usage

```blade
<flux:checkbox wire:model="terms" label="I agree to the terms and conditions" />
```

## Variants

### Checkbox Group

Organize a list of related checkboxes vertically:

```blade
<flux:checkbox.group wire:model="notifications" label="Notifications">
    <flux:checkbox label="Push notifications" value="push" checked />
    <flux:checkbox label="Email" value="email" checked />
    <flux:checkbox label="In-app alerts" value="app" />
    <flux:checkbox label="SMS" value="sms" />
</flux:checkbox.group>
```

### Check-all Control

Control a group of checkboxes with a single checkbox:

```blade
<flux:checkbox.group>
    <flux:checkbox.all />
    <flux:checkbox label="Caleb Porzio" checked />
    <flux:checkbox label="Hugo Sainte-Marie" />
    <flux:checkbox label="Keith Damiani" />
</flux:checkbox.group>
```

### With Descriptions

Add descriptive text below each checkbox label:

```blade
<flux:checkbox.group wire:model="subscription" label="Subscription preferences">
    <flux:checkbox 
        checked 
        value="newsletter" 
        label="Newsletter" 
        description="Receive our monthly newsletter with the latest updates and offers." 
    />
    <flux:checkbox 
        value="updates" 
        label="Product updates" 
        description="Stay informed about new features and product updates." 
    />
    <flux:checkbox 
        value="invitations" 
        label="Event invitations" 
        description="Get invitations to our exclusive events and webinars." 
    />
</flux:checkbox.group>
```

### Horizontal Layout

Organize checkboxes horizontally using Tailwind's flex utilities:

```blade
<flux:fieldset>
    <flux:legend>Languages</flux:legend>
    <flux:description>Choose the languages you want to support.</flux:description>
    <div class="flex gap-4 *:gap-x-2">
        <flux:checkbox checked value="english" label="English" />
        <flux:checkbox checked value="spanish" label="Spanish" />
        <flux:checkbox value="french" label="French" />
        <flux:checkbox value="german" label="German" />
    </div>
</flux:fieldset>
```

### Checkbox Cards (Pro)

A bordered alternative to standard checkboxes:

```blade
<flux:checkbox.group 
    wire:model="subscription" 
    label="Subscription preferences" 
    variant="cards" 
    class="max-sm:flex-col"
>
    <flux:checkbox 
        checked 
        value="newsletter" 
        label="Newsletter" 
        description="Get the latest updates and offers." 
    />
    <flux:checkbox 
        value="updates" 
        label="Product updates" 
        description="Learn about new features and products." 
    />
    <flux:checkbox 
        value="invitations" 
        label="Event invitations" 
        description="Invitations to exclusive events." 
    />
</flux:checkbox.group>
```

### Cards with Icons (Pro)

Add icons to checkbox cards and arrange them vertically:

```blade
<flux:checkbox.group 
    label="Subscription preferences" 
    variant="cards" 
    class="flex-col"
>
    <flux:checkbox 
        checked 
        value="newsletter" 
        icon="newspaper" 
        label="Newsletter" 
        description="Get the latest updates and offers." 
    />
    <flux:checkbox 
        value="updates" 
        icon="cube" 
        label="Product updates" 
        description="Learn about new features and products." 
    />
    <flux:checkbox 
        value="invitations" 
        icon="calendar" 
        label="Event invitations" 
        description="Invitations to exclusive events." 
    />
</flux:checkbox.group>
```

## States

### Checked State

Set a checkbox as checked by default:

```blade
<flux:checkbox checked label="Enable notifications" />
```

### Disabled State

Prevent interaction with a checkbox:

```blade
<flux:checkbox disabled label="Read and write" />
```

## Reference

### flux:checkbox

| Prop | Description |
|------|-------------|
| label | Text label for the checkbox |
| description | Additional descriptive text |
| checked | Whether the checkbox is checked by default |
| disabled | Whether the checkbox is disabled |
| value | Value for the checkbox when used in a group |
| wire:model | Livewire model binding |
| icon | Icon to display (Pro feature) |

### flux:checkbox.group

| Prop | Description |
|------|-------------|
| label | Group label text |
| wire:model | Livewire model binding for the group |
| variant | Visual style: "default" or "cards" (Pro) |
| class | Additional CSS classes |

### Accessibility

- Fully keyboard navigable
- Uses roving-tabindex for proper focus management
- Supports proper ARIA attributes and roles
- Screen reader compatible
- Follows native checkbox behavior patterns
``` 