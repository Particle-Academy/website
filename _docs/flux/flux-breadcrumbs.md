# Flux Breadcrumbs Component

Help users navigate and understand their place within your application with a hierarchical navigation structure.

## Basic Usage

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#">Home</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## Variants

### With Slashes

Use slashes instead of chevrons as separators:

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" separator="slash">Home</flux:breadcrumbs.item>
    <flux:breadcrumbs.item href="#" separator="slash">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item separator="slash">Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

### With Icon

Use an icon instead of text for a breadcrumb item:

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />
    <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

### With Ellipsis

Truncate a long breadcrumb list with an ellipsis:

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />
    <flux:breadcrumbs.item icon="ellipsis-horizontal" />
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

### With Ellipsis Dropdown

Truncate a long breadcrumb list into a single ellipsis dropdown:

```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="#" icon="home" />
    <flux:breadcrumbs.item>
        <flux:dropdown>
            <flux:button icon="ellipsis-horizontal" variant="ghost" size="sm" />
            <flux:navmenu>
                <flux:navmenu.item>Client</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-turn-down-right">Team</flux:navmenu.item>
                <flux:navmenu.item icon="arrow-turn-down-right">User</flux:navmenu.item>
            </flux:navmenu>
        </flux:dropdown>
    </flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## Example Use Cases

### Simple Navigation
```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="/" icon="home" />
    <flux:breadcrumbs.item href="/users">Users</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Profile</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

### Deep Navigation with Truncation
```blade
<flux:breadcrumbs>
    <flux:breadcrumbs.item href="/" icon="home" />
    <flux:breadcrumbs.item icon="ellipsis-horizontal" />
    <flux:breadcrumbs.item href="/projects">Projects</flux:breadcrumbs.item>
    <flux:breadcrumbs.item>Current Project</flux:breadcrumbs.item>
</flux:breadcrumbs>
```

## Reference

### flux:breadcrumbs

| Prop | Description |
|------|-------------|
| class | Additional CSS classes to apply to the breadcrumbs container |

### flux:breadcrumbs.item

| Prop | Description |
|------|-------------|
| href | URL for the breadcrumb link. If omitted, renders as text |
| icon | Icon to display instead of or alongside text |
| separator | Type of separator to use ("chevron" or "slash"). Default: "chevron" |
| current | Whether this is the current/active item. Automatically set for the last item | 