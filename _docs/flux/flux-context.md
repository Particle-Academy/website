# Flux Context Component

A context menu component for displaying actions and options in a right-click menu. This is a Pro component in Flux UI.

## Basic Usage

```blade
<flux:context>
    <flux:context.trigger>
        Right click me
    </flux:context.trigger>
    
    <flux:context.menu>
        <flux:context.item value="edit">Edit</flux:context.item>
        <flux:context.item value="delete">Delete</flux:context.item>
    </flux:context.menu>
</flux:context>
```

## Features

### With Icons

Add icons to menu items:

```blade
<flux:context>
    <flux:context.trigger>
        <div class="p-4 border rounded">
            Right click for options
        </div>
    </flux:context.trigger>
    
    <flux:context.menu>
        <flux:context.item value="edit" icon="pencil">
            Edit
        </flux:context.item>
        <flux:context.item value="duplicate" icon="document-duplicate">
            Duplicate
        </flux:context.item>
        <flux:context.item value="delete" icon="trash">
            Delete
        </flux:context.item>
    </flux:context.menu>
</flux:context>
```

### With Separators

Group related actions with separators:

```blade
<flux:context>
    <flux:context.trigger>
        <div class="p-4">Right click for options</div>
    </flux:context.trigger>
    
    <flux:context.menu>
        <flux:context.item value="view" icon="eye">View</flux:context.item>
        <flux:context.item value="edit" icon="pencil">Edit</flux:context.item>
        <flux:context.separator />
        <flux:context.item value="share" icon="share">Share</flux:context.item>
        <flux:context.separator />
        <flux:context.item value="delete" icon="trash" class="text-red-600">
            Delete
        </flux:context.item>
    </flux:context.menu>
</flux:context>
```

### With Submenus

Create nested context menus:

```blade
<flux:context>
    <flux:context.trigger>
        <div class="p-4">Right click for options</div>
    </flux:context.trigger>
    
    <flux:context.menu>
        <flux:context.item value="edit" icon="pencil">Edit</flux:context.item>
        <flux:context.submenu label="Share" icon="share">
            <flux:context.item value="copy-link" icon="link">
                Copy link
            </flux:context.item>
            <flux:context.item value="email" icon="envelope">
                Send via email
            </flux:context.item>
        </flux:context.submenu>
    </flux:context.menu>
</flux:context>
```

## Example Use Cases

### File Actions

```blade
<flux:context>
    <flux:context.trigger>
        <div class="p-4 border rounded flex items-center gap-2">
            <flux:icon name="document" />
            document.pdf
        </div>
    </flux:context.trigger>
    
    <flux:context.menu>
        <flux:context.item value="open" icon="arrow-top-right-on-square">
            Open
        </flux:context.item>
        <flux:context.item value="download" icon="arrow-down-tray">
            Download
        </flux:context.item>
        <flux:context.separator />
        <flux:context.submenu label="Share" icon="share">
            <flux:context.item value="copy-link" icon="link">
                Copy link
            </flux:context.item>
            <flux:context.item value="email" icon="envelope">
                Send via email
            </flux:context.item>
        </flux:context.submenu>
        <flux:context.separator />
        <flux:context.item value="rename" icon="pencil">
            Rename
        </flux:context.item>
        <flux:context.item value="delete" icon="trash" class="text-red-600">
            Delete
        </flux:context.item>
    </flux:context.menu>
</flux:context>
```

### Table Row Actions

```blade
<table>
    <tr>
        <flux:context>
            <flux:context.trigger>
                <td class="p-4">John Doe</td>
                <td class="p-4">john@example.com</td>
            </flux:context.trigger>
            
            <flux:context.menu>
                <flux:context.item value="view" icon="eye">
                    View Profile
                </flux:context.item>
                <flux:context.item value="edit" icon="pencil">
                    Edit User
                </flux:context.item>
                <flux:context.separator />
                <flux:context.item value="disable" icon="ban" class="text-yellow-600">
                    Disable Account
                </flux:context.item>
                <flux:context.item value="delete" icon="trash" class="text-red-600">
                    Delete User
                </flux:context.item>
            </flux:context.menu>
        </flux:context>
    </tr>
</table>
```

## Reference

### flux:context

| Prop       | Description                               |
| ---------- | ----------------------------------------- |
| class      | Additional CSS classes                    |
| wire:model | Livewire model binding for selected value |

### flux:context.trigger

The element that triggers the context menu on right-click.

### flux:context.menu

Container component for context menu items.

### flux:context.item

| Prop     | Description                         |
| -------- | ----------------------------------- |
| value    | Unique identifier for the menu item |
| icon     | Optional icon to display            |
| disabled | Whether the item is disabled        |
| class    | Additional CSS classes              |

### flux:context.submenu

| Prop  | Description                |
| ----- | -------------------------- |
| label | Text label for the submenu |
| icon  | Optional icon to display   |

### flux:context.separator

Component for adding visual separation between menu items.

### Events

| Event  | Description                        |
| ------ | ---------------------------------- |
| select | Fired when a menu item is selected |
| open   | Fired when the context menu opens  |
| close  | Fired when the context menu closes |

### Accessibility

- Fully keyboard navigable
- Supports arrow key navigation
- ARIA labels and roles for screen readers
- Focus management for menu behavior
- Proper keyboard shortcuts for context menu actions 