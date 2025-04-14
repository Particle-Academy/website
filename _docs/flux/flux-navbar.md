# Navbar Component

A navigation component that allows you to arrange navigation links horizontally or vertically, perfect for creating website headers and navigation menus.

## Basic Usage

```blade
<flux:navbar>
    <flux:navbar.item href="#">Home</flux:navbar.item>
    <flux:navbar.item href="#">Features</flux:navbar.item>
    <flux:navbar.item href="#">Pricing</flux:navbar.item>
    <flux:navbar.item href="#">About</flux:navbar.item>
</flux:navbar>
```

## Features

### With Icons

Add leading icons to provide visual context:

```blade
<flux:navbar>
    <flux:navbar.item href="#" icon="home">Home</flux:navbar.item>
    <flux:navbar.item href="#" icon="puzzle-piece">Features</flux:navbar.item>
    <flux:navbar.item href="#" icon="currency-dollar">Pricing</flux:navbar.item>
    <flux:navbar.item href="#" icon="user">About</flux:navbar.item>
</flux:navbar>
```

### With Badges

Add badges to navbar items for notifications or status indicators:

```blade
<flux:navbar>
    <flux:navbar.item href="#">Home</flux:navbar.item>
    <flux:navbar.item href="#" badge="12">Inbox</flux:navbar.item>
    <flux:navbar.item href="#">Contacts</flux:navbar.item>
    <flux:navbar.item href="#" badge="Pro" badge-color="lime">Calendar</flux:navbar.item>
</flux:navbar>
```

### Dropdown Navigation

Combine with dropdowns to create nested navigation menus:

```blade
<flux:navbar>
    <flux:navbar.item href="#">Dashboard</flux:navbar.item>
    <flux:navbar.item href="#">Transactions</flux:navbar.item>
    <flux:dropdown>
        <flux:navbar.item icon-trailing="chevron-down">Account</flux:navbar.item>
        <flux:navmenu>
            <flux:navmenu.item href="#">Profile</flux:navmenu.item>
            <flux:navmenu.item href="#">Settings</flux:navmenu.item>
            <flux:navmenu.item href="#">Billing</flux:navmenu.item>
        </flux:navmenu>
    </flux:dropdown>
</flux:navbar>
```

### Current Page Detection

The navbar automatically detects and marks the current page based on the `href` attribute. You can also manually control this behavior:

```blade
<!-- Automatic detection -->
<flux:navbar.item href="/about">About</flux:navbar.item>

<!-- Manual control -->
<flux:navbar.item href="/" current>Home</flux:navbar.item>
<flux:navbar.item href="/" :current="false">Home</flux:navbar.item>
<flux:navbar.item href="/" :current="request()->is('/')">Home</flux:navbar.item>
```

## Component Reference

### flux:navbar

A horizontal navigation container.

#### Slots
| Slot    | Description          |
| ------- | -------------------- |
| default | The navigation items |

#### Attributes
| Attribute        | Description                                                |
| ---------------- | ---------------------------------------------------------- |
| data-flux-navbar | Applied to the root element for styling and identification |

### flux:navbar.item

Individual navigation items within the navbar.

#### Props
| Prop          | Type    | Description                                             |
| ------------- | ------- | ------------------------------------------------------- |
| href          | string  | URL the item links to                                   |
| current       | boolean | Applies active styling (auto-detected if not specified) |
| icon          | string  | Name of the icon to display at the start of the item    |
| icon-trailing | string  | Name of the icon to display at the end of the item      |
| badge         | string  | Text to display in a badge                              |
| badge-color   | string  | Color variant for the badge (e.g., 'lime')              |

#### Attributes
| Attribute    | Description                             |
| ------------ | --------------------------------------- |
| data-current | Applied when the item is active/current |

## Best Practices

1. **Accessibility**
   - Use semantic HTML elements for navigation
   - Ensure proper ARIA attributes for current page indication
   - Maintain keyboard navigation support

2. **Responsive Design**
   - Consider mobile viewports when designing navigation
   - Use dropdowns for complex navigation structures
   - Implement appropriate spacing for touch targets

3. **Visual Hierarchy**
   - Use icons consistently to enhance recognition
   - Apply badges sparingly to maintain clarity
   - Ensure sufficient contrast for active/current states

## CSS Customization

The navbar can be styled using Tailwind CSS classes:

```blade
<flux:navbar class="your-custom-classes">
    <!-- Navigation items -->
</flux:navbar>
```

## Browser Support

The Navbar component is supported across all modern browsers with appropriate fallbacks for older browsers. 