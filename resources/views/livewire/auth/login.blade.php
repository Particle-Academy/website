<div>
    <flux:heading size="xl" class="font-bold text-center particle-text-gradient mb-6">Admin Login</flux:heading>
    
    <form wire:submit.prevent="login" class="space-y-6">
        <!-- Email Input -->
        <flux:field>
            <flux:label for="email">Email</flux:label>
            <flux:input 
                wire:model="email" 
                id="email" 
                type="email" 
                icon="envelope" 
                required 
                autofocus 
                autocomplete="username"
                class="particle-input"
            />
            <flux:error name="email" />
        </flux:field>

        <!-- Password Input -->
        <flux:field>
            <flux:label for="password">Password</flux:label>
            <flux:input 
                wire:model="password" 
                id="password" 
                type="password" 
                icon="lock-closed" 
                viewable 
                required 
                autocomplete="current-password"
                class="particle-input"
            />
            <flux:error name="password" />
        </flux:field>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <flux:field class="flex items-center space-x-2">
                <flux:checkbox wire:model="remember" id="remember" />
                <flux:label for="remember" class="ml-2">Remember me</flux:label>
            </flux:field>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full particle-button">
                Log in
            </button>
        </div>
    </form>
</div>
