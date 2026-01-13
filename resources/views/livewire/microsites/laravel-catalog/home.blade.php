<div>
    <!-- Hero / Search Section -->
    <section class="bg-red-600 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-600 to-red-800"></div>
        <!-- Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-800/50 text-white text-sm font-medium mb-8 border border-red-500/50">
                <flux:icon name="shopping-bag" class="w-4 h-4 text-white" />
                Commerce for Laravel
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Laravel Catalog</h1>
            <p class="text-red-100 text-xl max-w-2xl mx-auto mb-10">
                Product and Subscription management catalog with Stripe integration.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <flux:button variant="filled" class="bg-white hover:bg-gray-100 text-red-600 border-white text-lg h-auto px-8 py-3" href="https://github.com/Particle-Academy/laravel-catalog">
                    Get Started
                </flux:button>
                <flux:button variant="outline" class="border-red-400 text-white hover:bg-red-700 text-lg h-auto px-8 py-3" disabled>
                    Demos Coming Soon
                </flux:button>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Manage your Stripe catalog with ease</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Full CRUD for Products and Prices, automatic sync, and admin UI included.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                        <flux:icon name="cube" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Product Management</h3>
                    <p class="text-gray-600">Create, edit, and manage Stripe products with full CRUD operations directly from your app.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                        <flux:icon name="currency-dollar" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Flexible Pricing</h3>
                    <p class="text-gray-600">Support for recurring subscriptions and one-time purchases with multiple intervals.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 mb-4">
                        <flux:icon name="arrow-path-rounded-square" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Stripe Sync</h3>
                    <p class="text-gray-600">Automatic or manual synchronization with Stripe's catalog to keep everything in sync.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FMS Integration Section -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900 text-blue-200 text-sm font-medium mb-6 border border-blue-700">
                        <flux:icon name="puzzle-piece" class="w-4 h-4" />
                        Powerful Integration
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Works with Laravel FMS</h2>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Combine Catalog with our <a href="https://github.com/Particle-Academy/laravel-feature-management-system" class="text-blue-400 hover:underline">Feature Management System</a> to create feature-rich subscription plans.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <flux:icon name="check-circle" class="text-green-500 w-6 h-6" />
                            <span class="text-gray-200">Control feature access based on subscription plans</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon name="check-circle" class="text-green-500 w-6 h-6" />
                            <span class="text-gray-200">Metered usage limits (e.g., "100 API calls/month")</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon name="check-circle" class="text-green-500 w-6 h-6" />
                            <span class="text-gray-200">Toggle features on/off per plan</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-2xl">
                        <div class="flex items-center gap-2 mb-4 border-b border-gray-700 pb-4">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="ml-2 text-xs text-gray-500 font-mono">config/fms.php</span>
                        </div>
<pre class="font-mono text-sm text-blue-300 overflow-x-auto">
'features' => [
    'advanced-reporting' => [
        'name' => 'Advanced Reporting',
        'type' => 'boolean',
    ],
    'api-calls' => [
        'name' => 'API Calls',
        'type' => 'resource',
        'limit' => 5000,
    ],
],
</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation CTA -->
    <section id="install" class="py-20 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Ready to build your SaaS?</h2>
            
            <div class="max-w-2xl mx-auto bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex items-center justify-between gap-4 mb-8">
                <code class="text-red-600 font-mono text-sm sm:text-base">composer require particle-academy/laravel-catalog</code>
                <button class="text-gray-400 hover:text-gray-600">
                    <flux:icon name="clipboard" class="w-5 h-5" />
                </button>
            </div>
            
            <div class="flex justify-center gap-4">
                <flux:button variant="filled" class="bg-gray-900 hover:bg-gray-800 text-white px-6" href="https://github.com/Particle-Academy/laravel-catalog">
                    View on GitHub
                </flux:button>
            </div>
        </div>
    </section>
</div>
