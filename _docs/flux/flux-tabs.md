# Tabs Component

The Tabs component organizes content into separate panels within a single container, allowing users to switch between different sections without leaving the page.

> **Note**: For full-page navigation, use the Navbar component instead.

## Basic Usage

```blade
<flux:tab.group>
    <flux:tabs wire:model="tab">
        <flux:tab name="profile">Profile</flux:tab>
        <flux:tab name="account">Account</flux:tab>
        <flux:tab name="billing">Billing</flux:tab>
    </flux:tabs>
    <flux:tab.panel name="profile">
        <!-- Profile content -->
    </flux:tab.panel>
    <flux:tab.panel name="account">
        <!-- Account content -->
    </flux:tab.panel>
    <flux:tab.panel name="billing">
        <!-- Billing content -->
    </flux:tab.panel>
</flux:tab.group>
```

## Variants

### With Icons
Add icons to tab labels for visual distinction:

```blade
<flux:tab.group>
    <flux:tabs>
        <flux:tab name="profile" icon="user">Profile</flux:tab>
        <flux:tab name="account" icon="cog-6-tooth">Account</flux:tab>
        <flux:tab name="billing" icon="banknotes">Billing</flux:tab>
    </flux:tabs>
    <!-- Tab panels... -->
</flux:tab.group>
```

### Segmented Tabs
Button-like tabs ideal for toggling between views in constrained widths:

```blade
<flux:tabs variant="segmented">
    <flux:tab>List</flux:tab>
    <flux:tab>Board</flux:tab>
    <flux:tab>Timeline</flux:tab>
</flux:tabs>
```

### Small Segmented Tabs
Compact version for smaller layouts:

```blade
<flux:tabs variant="segmented" size="sm">
    <flux:tab>Demo</flux:tab>
    <flux:tab>Code</flux:tab>
</flux:tabs>
```

### Pill Tabs
Visually separated, pill-like tabs:

```blade
<flux:tabs variant="pills">
    <flux:tab>List</flux:tab>
    <flux:tab>Board</flux:tab>
    <flux:tab>Timeline</flux:tab>
</flux:tabs>
```

## Dynamic Tabs

You can dynamically generate tabs and panels in your Livewire component:

```blade
<flux:tab.group>
    <flux:tabs>
        @foreach($tabs as $id => $tab)
            <flux:tab :name="$id">{{ $tab }}</flux:tab>
        @endforeach
        <flux:tab icon="plus" wire:click="addTab" action>Add tab</flux:tab>
    </flux:tabs>
    @foreach($tabs as $id => $tab)
        <flux:tab.panel :name="$id">
            <!-- Panel content -->
        </flux:tab.panel>
    @endforeach
</flux:tab.group>
```

Livewire component example:
```php
class TabsExample extends Component
{
    public array $tabs = [
        'tab-1' => 'Tab #1',
        'tab-2' => 'Tab #2',
    ];

    public function addTab(): void
    {
        $id = 'tab-' . str()->random();
        $this->tabs[$id] = 'Tab #' . (count($this->tabs) + 1);
    }
}
```

## Component Reference

### flux:tab.group
| Prop           | Type   | Default | Description              |
| -------------- | ------ | ------- | ------------------------ |
| `defaultIndex` | number | 0       | Initial active tab index |

### flux:tabs
| Prop         | Type   | Default   | Description                                 |
| ------------ | ------ | --------- | ------------------------------------------- |
| `wire:model` | string | -         | Livewire model binding                      |
| `variant`    | string | 'default' | Tab style ('default', 'segmented', 'pills') |
| `size`       | string | 'default' | Size variant ('default', 'sm')              |
| `class`      | string | -         | Additional CSS classes                      |

### flux:tab
| Prop       | Type    | Default | Description                         |
| ---------- | ------- | ------- | ----------------------------------- |
| `name`     | string  | -       | Unique identifier for the tab       |
| `icon`     | string  | -       | Icon name to display                |
| `action`   | boolean | false   | Whether the tab is an action button |
| `disabled` | boolean | false   | Whether the tab is disabled         |

### flux:tab.panel
| Prop   | Type   | Default | Description                    |
| ------ | ------ | ------- | ------------------------------ |
| `name` | string | -       | Matches corresponding tab name |

## Styling

### Custom Padding
Add padding to tabs using Tailwind utilities:

```blade
<flux:tabs class="px-4">
    <flux:tab>Profile</flux:tab>
    <flux:tab>Account</flux:tab>
</flux:tabs>
```

## Best Practices

1. Tab Organization
   - Use clear, concise tab labels
   - Group related content logically
   - Limit the number of tabs to maintain usability

2. Visual Hierarchy
   - Use icons to enhance recognition
   - Consider the appropriate variant for your context
   - Maintain consistent styling across tab sets

3. Accessibility
   - Ensure keyboard navigation works properly
   - Provide appropriate ARIA labels
   - Maintain focus management

4. Content Management
   - Keep content within tabs focused and relevant
   - Consider loading states for dynamic content
   - Handle overflow appropriately

## CSS Customization

The Tabs component can be styled using CSS custom properties:

```css
.flux-tabs {
    /* Tab list styles */
    --tabs-border-color: theme(colors.gray.200);
    --tabs-background: theme(colors.white);
    
    /* Active tab styles */
    --tab-active-color: theme(colors.primary.600);
    --tab-active-border: theme(colors.primary.600);
    
    /* Hover states */
    --tab-hover-bg: theme(colors.gray.50);
}
``` 