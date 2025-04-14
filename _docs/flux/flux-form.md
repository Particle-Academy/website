# Flux Form Component

The Form component provides a structured way to collect user input with built-in validation, error handling, and submission management. It integrates seamlessly with other Flux form components to create cohesive and accessible forms.

## Basic Usage

The basic form component with input fields:

```blade
<flux:form>
    <flux:input name="email" label="Email" type="email" required />
    <flux:input name="password" label="Password" type="password" required />
    <flux:button type="submit">Submit</flux:button>
</flux:form>
```

## Variants

### With Validation

Add validation rules and error messages:

```blade
<flux:form>
    <flux:input 
        name="email" 
        label="Email" 
        type="email" 
        required 
        validation="email"
        error="Please enter a valid email address"
    />
    <flux:input 
        name="password" 
        label="Password" 
        type="password" 
        required
        validation="min:8"
        error="Password must be at least 8 characters"
    />
    <flux:button type="submit">Submit</flux:button>
</flux:form>
```

### With Loading State

Handle form submission states:

```blade
<flux:form x-data="{ loading: false }">
    <flux:input name="name" label="Name" required />
    <flux:input name="email" label="Email" type="email" required />
    <flux:button type="submit" :loading="loading">
        Submit
    </flux:button>
</flux:form>
```

### Grid Layout

Create multi-column form layouts:

```blade
<flux:form>
    <div class="grid grid-cols-2 gap-4">
        <flux:input name="first_name" label="First Name" required />
        <flux:input name="last_name" label="Last Name" required />
    </div>
    <flux:input name="email" label="Email" type="email" required />
    <flux:button type="submit">Submit</flux:button>
</flux:form>
```

### With Sections

Organize form fields into sections:

```blade
<flux:form>
    <flux:card>
        <flux:card.header>
            <flux:card.heading>Personal Information</flux:card.heading>
        </flux:card.header>
        <flux:card.content>
            <div class="space-y-4">
                <flux:input name="name" label="Full Name" required />
                <flux:input name="email" label="Email" type="email" required />
                <flux:input name="phone" label="Phone" type="tel" />
            </div>
        </flux:card.content>
    </flux:card>

    <flux:card class="mt-4">
        <flux:card.header>
            <flux:card.heading>Address</flux:card.heading>
        </flux:card.header>
        <flux:card.content>
            <div class="space-y-4">
                <flux:input name="street" label="Street Address" required />
                <div class="grid grid-cols-2 gap-4">
                    <flux:input name="city" label="City" required />
                    <flux:input name="postal_code" label="Postal Code" required />
                </div>
            </div>
        </flux:card.content>
    </flux:card>

    <div class="mt-4">
        <flux:button type="submit">Save Changes</flux:button>
    </div>
</flux:form>
```

## Example Use Cases

### Contact Form

Create a contact form with validation:

```blade
<flux:form>
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <flux:input 
                name="first_name" 
                label="First Name" 
                required 
                error="First name is required"
            />
            <flux:input 
                name="last_name" 
                label="Last Name" 
                required 
                error="Last name is required"
            />
        </div>

        <flux:input 
            name="email" 
            label="Email" 
            type="email" 
            required 
            validation="email"
            error="Please enter a valid email address"
        />

        <flux:textarea 
            name="message" 
            label="Message" 
            required 
            rows="4"
            error="Please enter your message"
        />

        <flux:checkbox name="subscribe">
            <flux:checkbox.label>Subscribe to newsletter</flux:checkbox.label>
        </flux:checkbox>

        <div class="flex justify-end">
            <flux:button type="submit">Send Message</flux:button>
        </div>
    </div>
</flux:form>
```

### Registration Form

Create a user registration form:

```blade
<flux:form>
    <div class="space-y-6">
        <div class="space-y-4">
            <flux:input 
                name="username" 
                label="Username" 
                required 
                validation="min:3"
                error="Username must be at least 3 characters"
            />

            <flux:input 
                name="email" 
                label="Email" 
                type="email" 
                required 
                validation="email"
                error="Please enter a valid email address"
            />

            <div class="grid grid-cols-2 gap-4">
                <flux:input 
                    name="password" 
                    label="Password" 
                    type="password" 
                    required 
                    validation="min:8"
                    error="Password must be at least 8 characters"
                />
                <flux:input 
                    name="password_confirmation" 
                    label="Confirm Password" 
                    type="password" 
                    required 
                    error="Passwords must match"
                />
            </div>
        </div>

        <div class="space-y-4">
            <flux:checkbox name="terms" required>
                <flux:checkbox.label>
                    I agree to the 
                    <flux:link href="/terms">Terms of Service</flux:link> and 
                    <flux:link href="/privacy">Privacy Policy</flux:link>
                </flux:checkbox.label>
            </flux:checkbox>

            <flux:checkbox name="marketing">
                <flux:checkbox.label>
                    I want to receive marketing emails
                </flux:checkbox.label>
            </flux:checkbox>
        </div>

        <div class="flex justify-end gap-3">
            <flux:button variant="ghost" type="button">Cancel</flux:button>
            <flux:button type="submit">Create Account</flux:button>
        </div>
    </div>
</flux:form>
```

## Reference

### flux:form

| Prop          | Description                                                                                                           |
| ------------- | --------------------------------------------------------------------------------------------------------------------- |
| method        | Form submission method: post, get, put, patch, delete. Default: post                                                   |
| action        | URL where the form will be submitted                                                                                  |
| validation    | Enable/disable form validation. Default: true                                                                          |
| prevent-default| Prevent default form submission. Default: true                                                                        |
| reset-on-success| Clear form after successful submission. Default: false                                                               |

| Slot          | Description                                                                                                           |
| ------------- | --------------------------------------------------------------------------------------------------------------------- |
| default       | Form content including inputs and buttons                                                                             |

### Events

| Event         | Description                                                                                                           |
| ------------- | --------------------------------------------------------------------------------------------------------------------- |
| submit        | Emitted when the form is submitted                                                                                    |
| success       | Emitted when form submission is successful                                                                            |
| error         | Emitted when form submission fails                                                                                    |
| reset         | Emitted when the form is reset                                                                                        | 