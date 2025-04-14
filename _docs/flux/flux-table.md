# Table Component

The Table component provides a powerful and flexible way to display tabular data with features like sorting, pagination, and customizable styling.

## Basic Usage

Here's a simple example of a basic table:

```blade
<flux:table>
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column>Date</flux:table.column>
        <flux:table.column>Status</flux:table.column>
        <flux:table.column>Amount</flux:table.column>
    </flux:table.columns>
    <flux:table.rows>
        <flux:table.row>
            <flux:table.cell>Lindsey Aminoff</flux:table.cell>
            <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>
            <flux:table.cell>
                <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
            </flux:table.cell>
            <flux:table.cell variant="strong">$49.00</flux:table.cell>
        </flux:table.row>
        <!-- More rows... -->
    </flux:table.rows>
</flux:table>
```

## Sortable Columns

Enable sorting on specific columns using the `sortable` prop:

```blade
<flux:table>
    <flux:table.columns>
        <flux:table.column>Customer</flux:table.column>
        <flux:table.column sortable sorted direction="desc">Date</flux:table.column>
        <flux:table.column sortable>Amount</flux:table.column>
    </flux:table.columns>
    <!-- Table rows... -->
</flux:table>
```

## Pagination

Add pagination to your table by passing a Laravel paginator to the `paginate` prop:

```blade
<!-- In your controller -->
$orders = \App\Models\Order::paginate(5);

<!-- In your view -->
<flux:table :paginate="$orders">
    <!-- Table content... -->
</flux:table>
```

## Component Reference

### flux:table
| Prop       | Type      | Default | Description                                     |
| ---------- | --------- | ------- | ----------------------------------------------- |
| `paginate` | Paginator | -       | Laravel paginator instance for table pagination |
| `hover`    | boolean   | false   | Enable hover state on table rows                |
| `striped`  | boolean   | false   | Enable striped rows                             |

### flux:table.column
| Prop        | Type    | Default | Description                            |
| ----------- | ------- | ------- | -------------------------------------- |
| `sortable`  | boolean | false   | Enable sorting for this column         |
| `sorted`    | boolean | false   | Indicate if column is currently sorted |
| `direction` | string  | 'asc'   | Sort direction ('asc' or 'desc')       |
| `width`     | string  | -       | Column width (e.g., 'w-32', 'w-1/4')   |

### flux:table.cell
| Prop      | Type   | Default | Description                                 |
| --------- | ------ | ------- | ------------------------------------------- |
| `variant` | string | -       | Cell style variant ('strong' for bold text) |
| `align`   | string | 'left'  | Text alignment ('left', 'center', 'right')  |

## Styling

### Cell Variants
Use the `variant` prop on table cells for different styles:
```blade
<flux:table.cell variant="strong">$49.00</flux:table.cell>
```

### Custom Cell Content
Cells can contain complex content including badges, images, and links:
```blade
<flux:table.cell>
    <flux:badge color="green" size="sm" inset="top bottom">
        Paid
    </flux:badge>
</flux:table.cell>
```

## Best Practices

1. Column Headers
   - Use clear, concise column headers
   - Enable sorting only when it adds value
   - Consider column width for better layout

2. Pagination
   - Choose appropriate page sizes
   - Show clear pagination controls
   - Include total record count when relevant

3. Data Presentation
   - Format dates consistently
   - Align numbers to the right
   - Use appropriate cell variants for emphasis

4. Accessibility
   - Provide proper table structure
   - Include descriptive headers
   - Ensure keyboard navigation works

## CSS Customization

The Table component can be styled using CSS custom properties:

```css
.flux-table {
    /* Table styles */
    --table-border-color: theme(colors.gray.200);
    --table-header-bg: theme(colors.gray.50);
    
    /* Row styles */
    --table-row-hover-bg: theme(colors.gray.50);
    --table-row-stripe-bg: theme(colors.gray.50);
    
    /* Cell styles */
    --table-cell-padding: theme(spacing.4);
}
``` 