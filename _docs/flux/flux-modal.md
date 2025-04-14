# Flux Modal Component

A modal component that displays content in a layer above the main page. Ideal for confirmations, alerts, forms, and any content that requires user attention or interaction.

## Basic Usage

```blade
<flux:modal.trigger name="example">
    <flux:button>Open modal</flux:button>
</flux:modal.trigger>

<flux:modal name="example">
    <div class="space-y-6">
        <flux:heading>Modal title</flux:heading>
        <p>Modal content goes here.</p>
    </div>
</flux:modal>
```

## Form Example

```blade
<flux:modal.trigger name="edit-profile">
    <flux:button>Edit profile</flux:button>
</flux:modal.trigger>

<flux:modal name="edit-profile" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Update profile</flux:heading>
            <flux:subheading>
                Make changes to your personal details.
            </flux:subheading>
        </div>

        <flux:input 
            label="Name" 
            placeholder="Your name"
        />

        <flux:input 
            label="Date of birth" 
            type="date"
        />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">
                Save changes
            </flux:button>
        </div>
    </div>
</flux:modal>
```

## Confirmation Dialog

```blade
<flux:modal.trigger name="confirm-delete">
    <flux:button variant="danger">Delete account</flux:button>
</flux:modal.trigger>

<flux:modal name="confirm-delete" class="max-w-sm">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete account</flux:heading>
            <flux:subheading>
                Are you sure you want to delete your account? This action cannot be undone.
            </flux:subheading>
        </div>

        <div class="flex gap-3">
            <flux:spacer />
            <flux:button 
                x-on:click="$modal.close('confirm-delete')"
            >
                Cancel
            </flux:button>
            <flux:button 
                variant="danger" 
                wire:click="deleteAccount"
            >
                Delete
            </flux:button>
        </div>
    </div>
</flux:modal>
```

## With Custom Width

```blade
<!-- Small modal -->
<flux:modal name="small" class="max-w-sm">
    <!-- Content -->
</flux:modal>

<!-- Medium modal -->
<flux:modal name="medium" class="max-w-md">
    <!-- Content -->
</flux:modal>

<!-- Large modal -->
<flux:modal name="large" class="max-w-lg">
    <!-- Content -->
</flux:modal>

<!-- Full width modal -->
<flux:modal name="full" class="max-w-full">
    <!-- Content -->
</flux:modal>
```

## Programmatic Control

Use Alpine.js to control modals programmatically:

```blade
<!-- Open modal -->
<button x-on:click="$modal.open('example')">
    Open
</button>

<!-- Close modal -->
<button x-on:click="$modal.close('example')">
    Close
</button>

<!-- Toggle modal -->
<button x-on:click="$modal.toggle('example')">
    Toggle
</button>
```

## Reference

### Props

| Prop      | Description                                                       |
| --------- | ----------------------------------------------------------------- |
| name      | Unique identifier for the modal                                   |
| class     | Additional CSS classes for the modal panel                        |
| closeable | Whether the modal can be closed by clicking outside or escape key |

### Slots

| Slot    | Description       |
| ------- | ----------------- |
| default | The modal content |

### Events

| Event  | Description                            |
| ------ | -------------------------------------- |
| open   | Triggered when the modal opens         |
| close  | Triggered when the modal closes        |
| toggle | Triggered when the modal toggles state |

### CSS Features

- Responsive sizing
- Dark mode support
- Focus trap within modal
- Backdrop blur effect
- Smooth transitions
- Flexible content layout
- Custom width control
- Z-index management

### Accessibility

- Focus management
- Keyboard navigation
- ARIA attributes
- Screen reader announcements
- Focus trap
- Escape key handling
- Click outside handling

### Best Practices

1. Use descriptive titles and content
2. Keep modals focused on a single task
3. Provide clear actions and feedback
4. Consider mobile responsiveness
5. Implement proper focus management
6. Use appropriate sizes for different content
7. Handle loading and error states
8. Provide clear close/cancel options
9. Consider keyboard navigation
10. Maintain consistent styling 