<div>
    <!-- Hero Section -->
    <section id="home" class="relative py-20 lg:py-32 bg-stone-50 overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <flux:badge variant="pill" class="mb-6 bg-teal-100 text-teal-800 border-teal-200">Community Resource Sharing</flux:badge>
                <h1 class="text-5xl md:text-7xl font-extrabold text-stone-900 mb-6 tracking-tight leading-tight">
                    Share Smarter. <br>
                    <span class="text-teal-600">Live Better.</span>
                </h1>
                <p class="text-xl md:text-2xl text-stone-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    The easy way for small communities to share vehicles, equipment, and spaces with transparent tracking and fair billing.
                </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <flux:button variant="primary" class="px-8 py-3 text-lg h-auto" href="https://github.com/Particle-Academy/tribe-trip">
                    Get Started
                </flux:button>
                <flux:button variant="outline" class="border-stone-300 hover:bg-stone-100 text-stone-700 px-8 py-3 text-lg h-auto" disabled>
                    Demo Coming Soon
                </flux:button>
            </div>
            </div>
        </div>
        
        <!-- Background decoration -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-0 opacity-10 pointer-events-none">
             <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="absolute w-full h-full text-teal-200 fill-current">
                <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
             </svg>
        </div>
    </section>

    <!-- Problem / Solution Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-24 h-24 bg-teal-100 rounded-full opacity-50 z-0"></div>
                        <div class="relative z-10 bg-stone-100 rounded-2xl p-8 shadow-xl rotate-2 hover:rotate-0 transition-transform duration-500 border border-stone-200">
                             <div class="space-y-4">
                                 <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                     <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-500">
                                         <flux:icon name="x-mark" class="w-5 h-5" />
                                     </div>
                                     <span class="text-stone-600">Scheduling conflicts</span>
                                 </div>
                                 <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                     <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-500">
                                         <flux:icon name="x-mark" class="w-5 h-5" />
                                     </div>
                                     <span class="text-stone-600">Unclear accountability</span>
                                 </div>
                                 <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                                     <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-500">
                                         <flux:icon name="x-mark" class="w-5 h-5" />
                                     </div>
                                     <span class="text-stone-600">Unfair cost splitting</span>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-stone-900 mb-6">Stop managing resources with clipboards and text chains.</h2>
                    <div class="space-y-6 text-lg text-stone-600">
                        <p>
                            Small communities often share resources informally, leading to double-bookings, damage disputes, and administrative headaches.
                        </p>
                        <p>
                            Tribe Trip provides a complete platform to professionalize your sharing economy without losing the community feel.
                        </p>
                        <div class="pt-4">
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3">
                                    <flux:icon name="check-circle" class="text-teal-600 w-6 h-6" />
                                    <span>Visual calendar booking</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <flux:icon name="check-circle" class="text-teal-600 w-6 h-6" />
                                    <span>Photo-based check-in/out</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <flux:icon name="check-circle" class="text-teal-600 w-6 h-6" />
                                    <span>Automated usage invoicing</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-stone-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-stone-900 mb-4">Everything you need to share</h2>
                <p class="text-lg text-stone-600 max-w-2xl mx-auto">From booking to billing, we handle the logistics so you can focus on the resource.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-6 text-teal-600">
                        <flux:icon name="calendar" variant="solid" class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Easy Reservations</h3>
                    <p class="text-stone-600 leading-relaxed">
                        Visual calendar shows real-time availability. Book vehicles, equipment, or spaces instantly from any device.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-6 text-teal-600">
                        <flux:icon name="camera" variant="solid" class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Mobile Check-out</h3>
                    <p class="text-stone-600 leading-relaxed">
                        Capture odometer readings and condition photos right on your phone before and after use for full accountability.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-6 text-teal-600">
                        <flux:icon name="currency-dollar" variant="solid" class="w-8 h-8" />
                    </div>
                    <h3 class="text-xl font-bold text-stone-900 mb-3">Fair Billing</h3>
                    <p class="text-stone-600 leading-relaxed">
                        Track usage by mile, hour, or flat fee. Automatically generate itemized monthly invoices for every member.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases -->
    <section id="use-cases" class="py-20 bg-white border-t border-stone-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-stone-900">Perfect for...</h2>
            <div class="grid md:grid-cols-4 gap-6 text-center">
                <div class="p-6 bg-stone-50 rounded-xl">
                    <div class="font-bold text-lg mb-2">HOAs</div>
                    <p class="text-stone-600 text-sm">Share tools, clubhouses, and maintenance equipment.</p>
                </div>
                <div class="p-6 bg-stone-50 rounded-xl">
                    <div class="font-bold text-lg mb-2">Co-ops</div>
                    <p class="text-stone-600 text-sm">Manage shared vehicles, cargo bikes, and guest rooms.</p>
                </div>
                <div class="p-6 bg-stone-50 rounded-xl">
                    <div class="font-bold text-lg mb-2">Churches</div>
                    <p class="text-stone-600 text-sm">Coordinate van usage, AV equipment, and event spaces.</p>
                </div>
                <div class="p-6 bg-stone-50 rounded-xl">
                    <div class="font-bold text-lg mb-2">Clubs</div>
                    <p class="text-stone-600 text-sm">Track specialized gear, boats, or recreational assets.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact / CTA -->
    <section id="contact" class="py-20 bg-stone-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-teal-900/20"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-6">Ready to organize your community?</h2>
            <p class="text-xl text-stone-300 mb-10 max-w-2xl mx-auto">
                Tribe Trip is open source and available for self-hosting. Hosted version coming soon.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <flux:button variant="primary" href="https://github.com/Particle-Academy/tribe-trip">
                    <flux:icon name="code-bracket" class="w-4 h-4 mr-2" /> View on GitHub
                </flux:button>
                <flux:button variant="outline" class="border-stone-600 hover:bg-stone-800 text-stone-300 hover:text-white">
                    Join Hosted Waitlist
                </flux:button>
            </div>
        </div>
    </section>
</div>
