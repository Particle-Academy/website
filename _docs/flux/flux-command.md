# Flux Command Component

A searchable command palette component for quick access to actions and navigation. This is a Pro component in Flux UI.

## Basic Usage

```blade
<flux:command>
    <flux:command.input placeholder="Search commands..." />
    <flux:command.list>
        <flux:command.item value="new-file">
            Create new file
            <flux:command.shortcut>⌘N</flux:command.shortcut>
        </flux:command.item>
        <flux:command.item value="settings">
            Settings
            <flux:command.shortcut>ctrl+k</flux:command.shortcut>
        </flux:command.item>
    </flux:command.list>
</flux:command>
```

## Features

### With Categories

Group commands into categories:

```blade
<flux:command>
    <flux:command.input placeholder="Search commands..." />
    <flux:command.list>
        <flux:command.group heading="File">
            <flux:command.item value="new-file">
                Create new file
                <flux:command.shortcut>⌘N</flux:command.shortcut>
            </flux:command.item>
            <flux:command.item value="new-project">
                Create new project
                <flux:command.shortcut>⌘⇧N</flux:command.shortcut>
            </flux:command.item>
        </flux:command.group>
        
        <flux:command.group heading="Help">
            <flux:command.item value="docs">Documentation</flux:command.item>
            <flux:command.item value="changelog">Changelog</flux:command.item>
        </flux:command.group>
    </flux:command.list>
</flux:command>
```

### With Icons

Add icons to command items:

```blade
<flux:command>
    <flux:command.input placeholder="Search commands..." />
    <flux:command.list>
        <flux:command.item value="settings" icon="cog">
            Settings
            <flux:command.shortcut>⌘,</flux:command.shortcut>
        </flux:command.item>
        <flux:command.item value="profile" icon="user">
            Profile
        </flux:command.item>
    </flux:command.list>
</flux:command>
```

### Empty State

Customize the empty state message:

```blade
<flux:command>
    <flux:command.input placeholder="Search commands..." />
    <flux:command.list>
        <flux:command.empty>
            No commands found.
        </flux:command.empty>
        <!-- command items -->
    </flux:command.list>
</flux:command>
```

## Example Use Cases

### Application Navigation

```blade
<flux:command>
    <flux:command.input placeholder="Where would you like to go?" />
    <flux:command.list>
        <flux:command.group heading="Navigation">
            <flux:command.item value="dashboard" icon="home">Dashboard</flux:command.item>
            <flux:command.item value="projects" icon="folder">Projects</flux:command.item>
            <flux:command.item value="team" icon="users">Team</flux:command.item>
            <flux:command.item value="settings" icon="cog">Settings</flux:command.item>
        </flux:command.group>
    </flux:command.list>
</flux:command>
```

### Text Editor Commands

```blade
<flux:command>
    <flux:command.input placeholder="Search formatting options..." />
    <flux:command.list>
        <flux:command.group heading="Text">
            <flux:command.item value="bold" icon="bold">
                Bold
                <flux:command.shortcut>⌘B</flux:command.shortcut>
            </flux:command.item>
            <flux:command.item value="italic" icon="italic">
                Italic
                <flux:command.shortcut>⌘I</flux:command.shortcut>
            </flux:command.item>
        </flux:command.group>
        <flux:command.group heading="Lists">
            <flux:command.item value="bullet-list" icon="list-bullet">
                Bullet list
            </flux:command.item>
            <flux:command.item value="numbered-list" icon="list-number">
                Numbered list
            </flux:command.item>
        </flux:command.group>
    </flux:command.list>
</flux:command>
```

## Reference

### flux:command

| Prop | Description |
|------|-------------|
| class | Additional CSS classes |
| wire:model | Livewire model binding for selected value |

### flux:command.input

| Prop | Description |
|------|-------------|
| placeholder | Placeholder text for the search input |

### flux:command.list

Container component for command items and groups.

### flux:command.group

| Prop | Description |
|------|-------------|
| heading | Group heading text |

### flux:command.item

| Prop | Description |
|------|-------------|
| value | Unique identifier for the command |
| icon | Optional icon to display |
| disabled | Whether the item is disabled |

### flux:command.shortcut

Component for displaying keyboard shortcuts.

### flux:command.empty

Component for customizing the empty state message.

### Events

| Event | Description |
|-------|-------------|
| select | Fired when a command is selected |
| search | Fired when the search input changes |
| open | Fired when the command palette opens |
| close | Fired when the command palette closes |

### Accessibility

- Fully keyboard navigable
- Supports arrow key navigation
- Type to search functionality
- ARIA labels and roles for screen readers
- Focus management for modal behavior 