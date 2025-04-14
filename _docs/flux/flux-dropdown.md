# Flux Dropdown Component

A composable dropdown component that can handle both simple navigation menus as well as complex action menus with checkboxes, radios, and submenus.

## Basic Usage

```blade
<flux:dropdown>
    <flux:button icon-trailing="chevron-down">Options</flux:button>
    <flux:menu>
        <flux:menu.item icon="plus">New post</flux:menu.item>
        <flux:menu.separator />
        <flux:menu.item>Settings</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Features

### Complex Menu with Submenus

Create rich dropdown menus with radio groups and checkboxes:

```blade
<flux:dropdown>
    <flux:button icon-trailing="chevron-down">Options</flux:button>
    <flux:menu>
        <flux:menu.item icon="plus">New post</flux:menu.item>
        <flux:menu.separator />
        <flux:menu.submenu heading="Sort by">
            <flux:menu.radio.group>
                <flux:menu.radio checked>Name</flux:menu.radio>
                <flux:menu.radio>Date</flux:menu.radio>
                <flux:menu.radio>Popularity</flux:menu.radio>
            </flux:menu.radio.group>
        </flux:menu.submenu>
        <flux:menu.submenu heading="Filter">
            <flux:menu.checkbox checked>Draft</flux:menu.checkbox>
            <flux:menu.checkbox checked>Published</flux:menu.checkbox>
            <flux:menu.checkbox>Archived</flux:menu.checkbox>
        </flux:menu.submenu>
        <flux:menu.separator />
        <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

### Navigation Menu

Create simple navigation menus:

```blade
<flux:dropdown position="bottom" align="end">
    <flux:profile avatar="/img/demo/user.png" name="Olivia Martin" />
    <flux:navmenu>
        <flux:navmenu.item href="#" icon="user">Account</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="building-storefront">Profile</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="credit-card">Billing</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>
        <flux:navmenu.item href="#" icon="trash" variant="danger">Delete</flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>
```

### Positioning

Control the position and alignment of the dropdown menu:

```blade
<!-- Top alignment -->
<flux:dropdown position="top" align="start">
    <!-- content -->
</flux:dropdown>

<!-- Right alignment -->
<flux:dropdown position="right" align="center">
    <!-- content -->
</flux:dropdown>

<!-- Bottom alignment -->
<flux:dropdown position="bottom" align="center">
    <!-- content -->
</flux:dropdown>

<!-- Left alignment -->
<flux:dropdown position="left" align="end">
    <!-- content -->
</flux:dropdown>
```

### Offset & Gap

Customize the spacing of the dropdown menu:

```blade
<flux:dropdown offset="-15" gap="2">
    <!-- content -->
</flux:dropdown>
```

## Example Use Cases

### User Profile Menu

```blade
<flux:dropdown position="bottom" align="end">
    <flux:profile 
        avatar="/path/to/avatar.jpg" 
        name="John Doe"
    />
    <flux:navmenu>
        <flux:navmenu.item href="/profile" icon="user">
            Profile
        </flux:navmenu.item>
        <flux:navmenu.item href="/settings" icon="cog">
            Settings
        </flux:navmenu.item>
        <flux:navmenu.separator />
        <flux:navmenu.item href="/logout" icon="logout" variant="danger">
            Logout
        </flux:navmenu.item>
    </flux:navmenu>
</flux:dropdown>
```

### Action Menu

```blade
<flux:dropdown>
    <flux:button icon-trailing="chevron-down">Actions</flux:button>
    <flux:menu>
        <flux:menu.item icon="eye">View</flux:menu.item>
        <flux:menu.item icon="pencil">Edit</flux:menu.item>
        <flux:menu.separator />
        <flux:menu.submenu heading="Move to">
            <flux:menu.item icon="folder">Projects</flux:menu.item>
            <flux:menu.item icon="archive">Archive</flux:menu.item>
        </flux:menu.submenu>
        <flux:menu.separator />
        <flux:menu.item variant="danger" icon="trash">
            Delete
        </flux:menu.item>
    </flux:menu>
</flux:dropdown>
```

## Reference

### flux:dropdown

| Prop | Description |
|------|-------------|
| position | Dropdown position: "top", "right", "bottom", "left" |
| align | Alignment: "start", "center", "end" |
| offset | Offset from trigger element (in pixels) |
| gap | Space between trigger and dropdown (in pixels) |

### flux:menu

Container component for dropdown menu items.

### flux:menu.item

| Prop | Description |
|------|-------------|
| icon | Optional icon to display |
| variant | Visual style: "default", "danger" |
| disabled | Whether the item is disabled |

### flux:menu.submenu

| Prop | Description |
|------|-------------|
| heading | Submenu heading text |

### flux:menu.radio.group

Container for radio options.

### flux:menu.radio

| Prop | Description |
|------|-------------|
| checked | Whether the radio is selected |
| disabled | Whether the radio is disabled |

### flux:menu.checkbox

| Prop | Description |
|------|-------------|
| checked | Whether the checkbox is checked |
| disabled | Whether the checkbox is disabled |

### flux:menu.separator

Component for adding visual separation between menu items.

### flux:navmenu

Container for navigation menu items.

### flux:navmenu.item

| Prop | Description |
|------|-------------|
| href | Link destination |
| icon | Optional icon to display |
| variant | Visual style: "default", "danger" |

### Accessibility

- Fully keyboard navigable
- Arrow key navigation for menu items
- Escape key closes dropdown
- ARIA labels and roles
- Focus management for menu items
``` 