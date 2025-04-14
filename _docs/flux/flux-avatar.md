# Flux Avatar Component

The Avatar component is used to represent users with images, initials, or fallback icons. It supports various sizes and styles, making it perfect for user profiles, comment sections, and team displays.

## Basic Usage

The basic avatar component displays a user's image or initials:

```blade
<flux:avatar src="path/to/image.jpg" alt="John Doe" />
```

## Variants

### With Initials

When no image is provided, the avatar will display initials:

```blade
<flux:avatar name="John Doe" />
```

### With Fallback Icon

Use a fallback icon when no image or name is provided:

```blade
<flux:avatar icon="user" />
```

### Sizes

Choose from different predefined sizes:

```blade
<flux:avatar src="path/to/image.jpg" size="xs" />
<flux:avatar src="path/to/image.jpg" size="sm" />
<flux:avatar src="path/to/image.jpg" size="md" />
<flux:avatar src="path/to/image.jpg" size="lg" />
<flux:avatar src="path/to/image.jpg" size="xl" />
```

### Shapes

Choose between circle and square shapes:

```blade
<flux:avatar src="path/to/image.jpg" shape="circle" />
<flux:avatar src="path/to/image.jpg" shape="square" />
```

### With Status

Add a status indicator:

```blade
<flux:avatar src="path/to/image.jpg" status="online" />
<flux:avatar src="path/to/image.jpg" status="away" />
<flux:avatar src="path/to/image.jpg" status="busy" />
<flux:avatar src="path/to/image.jpg" status="offline" />
```

### With Custom Status Color

Use a custom color for the status indicator:

```blade
<flux:avatar src="path/to/image.jpg" status-color="purple" />
```

### With Border

Add a border around the avatar:

```blade
<flux:avatar src="path/to/image.jpg" bordered />
```

### Avatar Group

Display multiple avatars as a group:

```blade
<flux:avatar.group>
    <flux:avatar src="path/to/user1.jpg" alt="User 1" />
    <flux:avatar src="path/to/user2.jpg" alt="User 2" />
    <flux:avatar src="path/to/user3.jpg" alt="User 3" />
    <flux:avatar>+3</flux:avatar>
</flux:avatar.group>
```

## Example Use Cases

### User Profile

Display a user's avatar with status:

```blade
<div class="flex items-center gap-3">
    <flux:avatar 
        src="path/to/image.jpg" 
        name="John Doe" 
        status="online" 
        size="lg" 
    />
    <div>
        <h3 class="font-medium">John Doe</h3>
        <p class="text-sm text-gray-500">Product Designer</p>
    </div>
</div>
```

### Comment Section

Show avatars in a comment thread:

```blade
<div class="space-y-4">
    <div class="flex gap-3">
        <flux:avatar src="path/to/user1.jpg" name="Alice Smith" size="sm" />
        <div class="flex-1">
            <h4 class="font-medium">Alice Smith</h4>
            <p class="text-sm">Great work on this feature!</p>
        </div>
    </div>
    <div class="flex gap-3">
        <flux:avatar src="path/to/user2.jpg" name="Bob Johnson" size="sm" />
        <div class="flex-1">
            <h4 class="font-medium">Bob Johnson</h4>
            <p class="text-sm">Thanks for the feedback!</p>
        </div>
    </div>
</div>
```

### Team Members

Display a group of team members with hover details:

```blade
<flux:avatar.group size="md">
    <flux:avatar 
        src="path/to/user1.jpg" 
        alt="Team Lead" 
        status="online"
        title="Sarah Wilson - Team Lead"
    />
    <flux:avatar 
        src="path/to/user2.jpg" 
        alt="Developer" 
        status="busy"
        title="Mike Chen - Developer"
    />
    <flux:avatar 
        src="path/to/user3.jpg" 
        alt="Designer" 
        status="away"
        title="Emma Davis - Designer"
    />
    <flux:avatar title="3 more team members">+3</flux:avatar>
</flux:avatar.group>
```

## Reference

### flux:avatar

| Prop         | Description                                                                                                           |
| ------------ | --------------------------------------------------------------------------------------------------------------------- |
| src          | URL of the avatar image                                                                                               |
| alt          | Alternative text for the image                                                                                        |
| name         | User's name (used for generating initials when no image is provided)                                                  |
| size         | Size of the avatar: xs, sm, md, lg, xl. Default: md                                                                  |
| shape        | Shape of the avatar: circle, square. Default: circle                                                                  |
| status       | Status indicator: online, away, busy, offline                                                                         |
| status-color | Custom color for the status indicator (uses Tailwind colors)                                                          |
| bordered     | If true, adds a border around the avatar. Default: false                                                              |
| icon         | Name of the fallback icon to use when no image or initials are available                                             |
| title        | Tooltip text shown on hover                                                                                           |

### flux:avatar.group

| Prop     | Description                                                                                                           |
| -------- | --------------------------------------------------------------------------------------------------------------------- |
| size     | Size of all avatars in the group: xs, sm, md, lg, xl. Default: md                                                     |
| max      | Maximum number of avatars to show before using a count. Default: undefined (shows all)                                 |
| spacing  | Space between avatars: tight, normal, loose. Default: normal                                                           |

| Slot    | Description                                                                                                           |
| ------- | --------------------------------------------------------------------------------------------------------------------- |
| default | Avatar components to display in the group                                                                              |
``` 