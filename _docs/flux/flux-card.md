# Flux Card Component

A container for related content, such as forms, alerts, or data lists. Cards provide a flexible and extensible content container.

## Basic Usage

```blade
<flux:card>
    <flux:heading>Card Title</flux:heading>
    <p>Card content goes here.</p>
</flux:card>
```

## Example Use Cases

### Login Form Card

```blade
<flux:card class="space-y-6">
    <div>
        <flux:heading size="lg">Log in to your account</flux:heading>
        <flux:subheading>Welcome back!</flux:subheading>
    </div>
    
    <div class="space-y-6">
        <flux:input 
            label="Email" 
            type="email" 
            placeholder="Your email address" 
        />
        
        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Password</flux:label>
                <flux:link href="#" variant="subtle" class="text-sm">
                    Forgot password?
                </flux:link>
            </div>
            <flux:input 
                type="password" 
                placeholder="Your password" 
            />
            <flux:error name="password" />
        </flux:field>
    </div>
    
    <div class="space-y-2">
        <flux:button variant="primary" class="w-full">
            Log in
        </flux:button>
        <flux:button variant="ghost" class="w-full">
            Sign up for a new account
        </flux:button>
    </div>
</flux:card>
```

### Content Card

```blade
<flux:card>
    <flux:heading>Latest Updates</flux:heading>
    <flux:subheading>What's new in our latest release</flux:subheading>
    <div class="mt-4">
        <ul class="space-y-2">
            <li>New feature: Dark mode support</li>
            <li>Improved performance</li>
            <li>Bug fixes and stability improvements</li>
        </ul>
    </div>
    <div class="mt-4">
        <flux:button>Learn More</flux:button>
    </div>
</flux:card>
```

### Media Card

```blade
<flux:card>
    <img src="/path/to/image.jpg" alt="Card image" class="rounded-t-lg">
    <div class="p-4">
        <flux:heading>Featured Article</flux:heading>
        <p class="mt-2">A brief description of the article content goes here.</p>
        <flux:button variant="ghost" class="mt-4">
            Read More
        </flux:button>
    </div>
</flux:card>
```

## Variants

### With Shadow

```blade
<flux:card shadow="lg">
    <!-- Card content -->
</flux:card>
```

### With Border

```blade
<flux:card border>
    <!-- Card content -->
</flux:card>
```

### With Hover Effect

```blade
<flux:card hover>
    <!-- Card content -->
</flux:card>
```

## Reference

### flux:card

| Prop | Description |
|------|-------------|
| class | Additional CSS classes to apply to the card |
| shadow | Shadow size: "sm", "md", "lg" |
| border | Whether to show a border |
| hover | Whether to show hover effects |
| padding | Custom padding for the card content |

### Slots

| Slot | Description |
|------|-------------|
| default | The card content |
| header | Optional header content |
| footer | Optional footer content |

### Best Practices

1. Use cards to group related content and actions
2. Maintain consistent spacing within and between cards
3. Use appropriate heading hierarchy within cards
4. Consider using the `space-y-{size}` utility class for consistent vertical spacing between card elements
5. Add hover states for interactive cards
6. Use shadows and borders to create visual hierarchy 