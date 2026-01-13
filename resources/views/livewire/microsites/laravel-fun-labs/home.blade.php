<div>
    <!-- Hero Section -->
    <section id="home" class="relative py-20 lg:py-32 overflow-hidden bg-white">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 text-purple-700 text-sm font-medium mb-8 border border-purple-200">
                <flux:icon name="trophy" class="w-4 h-4 text-purple-600" />
                Gamification for Laravel
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 mb-6 tracking-tighter">
                Laravel <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Fun Lab</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed font-light">
                Analytics disguised as gamification. Turn user activity into meaningful engagement insights with a complete award system.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <flux:button variant="primary" class="px-8 py-3 text-lg h-auto shadow-lg shadow-purple-200" href="https://github.com/Particle-Academy/laravel-fun-labs">
                    Get Started
                </flux:button>
                <flux:button variant="outline" icon="book-open" class="border-slate-300 hover:bg-white text-slate-700 px-8 py-3 text-lg h-auto" disabled>
                    Demos Coming Soon
                </flux:button>
            </div>
        </div>
        
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-purple-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-pink-100 rounded-full blur-3xl opacity-50"></div>
    </section>

    <!-- Value Proposition -->
    <section id="features" class="py-20 bg-slate-50 border-y border-slate-200">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Engage Users. Capture Data.</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Developers get engagement data "for free," users feel recognized and motivated.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-6 text-purple-600">
                        <flux:icon name="trophy" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Flexible Awards</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Grant points, achievements, badges, and prizes based on any user action or system event.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center mb-6 text-pink-600">
                        <flux:icon name="chart-bar" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Built-in Analytics</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Query aggregate engagement data to understand what drives long-term adoption and user behavior.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 text-indigo-600">
                        <flux:icon name="puzzle-piece" variant="solid" class="w-6 h-6" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Drop-in UI</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Includes optional Blade/Livewire components for leaderboards, profiles, and notifications.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Code Example Section -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Simple, Fluent API</h2>
                    <p class="text-slate-300 text-lg mb-8">
                        Designed to be readable and expressive. Awarding points or unlocking achievements takes just a few lines of code.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-slate-300">
                            <flux:icon name="check" class="text-green-400 w-5 h-5" />
                            <span>Event-driven architecture</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <flux:icon name="check" class="text-green-400 w-5 h-5" />
                            <span>Extensible via macros and hooks</span>
                        </li>
                        <li class="flex items-center gap-3 text-slate-300">
                            <flux:icon name="check" class="text-green-400 w-5 h-5" />
                            <span>Database agnostic analytics</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2 w-full">
                    <div class="bg-slate-800 rounded-xl p-6 font-mono text-sm shadow-2xl border border-slate-700 overflow-x-auto">
                        <div class="flex gap-2 mb-4">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
<pre class="text-purple-300">use <span class="text-white">LaravelFunLab\Facades\LFL;</span>

<span class="text-slate-400">// Award points with context</span>
<span class="text-white">LFL</span>::<span class="text-blue-400">award</span>(<span class="text-green-400">'points'</span>)
    -><span class="text-blue-400">to</span>(<span class="text-white">$user</span>)
    -><span class="text-blue-400">for</span>(<span class="text-green-400">'completed task'</span>)
    -><span class="text-blue-400">amount</span>(<span class="text-orange-400">50</span>)
    -><span class="text-blue-400">grant</span>();

<span class="text-slate-400">// Unlock an achievement</span>
<span class="text-white">LFL</span>::<span class="text-blue-400">grantAchievement</span>(
    <span class="text-white">$user</span>, 
    <span class="text-green-400">'first-login'</span>
);</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation / CTA -->
    <section id="install" class="py-20 bg-white">
        <div class="container mx-auto px-4 text-center max-w-3xl">
            <div class="mb-8">
                <flux:icon name="command-line" class="w-12 h-12 text-slate-400 mx-auto mb-4" />
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Ready to gamify your app?</h2>
                <p class="text-lg text-slate-600">Install via Composer and start tracking engagement in minutes.</p>
            </div>
            
            <div class="bg-slate-100 p-4 rounded-lg font-mono text-slate-700 mb-8 inline-flex items-center gap-4">
                <span>composer require particleacademy/laravel-fun-lab</span>
                <button class="text-slate-400 hover:text-slate-600">
                    <flux:icon name="clipboard" class="w-5 h-5" />
                </button>
            </div>
            
            <div class="flex justify-center gap-4">
                <flux:button variant="filled" class="bg-slate-900 hover:bg-slate-800 text-white px-6" href="https://github.com/Particle-Academy/laravel-fun-labs">
                    View on GitHub
                </flux:button>
            </div>
        </div>
    </section>
</div>
