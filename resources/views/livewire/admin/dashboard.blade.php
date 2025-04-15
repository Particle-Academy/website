<div>
    @section('header', 'Admin Dashboard')
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Waiting List Stats Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-cyan-100 text-cyan-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Waiting List</div>
                        <div class="text-3xl font-semibold text-gray-800">{{ $waitingListCount }}</div>
                        <div class="text-gray-500 text-xs">Total Registrations</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.waitinglist') }}" class="text-cyan-600 hover:text-cyan-800 text-sm font-medium">
                        View Waiting List →
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Stories Stats Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Success Stories</div>
                        <div class="text-3xl font-semibold text-gray-800">{{ $storyCount }}</div>
                        <div class="text-gray-500 text-xs">Published Stories</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.stories') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                        Manage Stories →
                    </a>
                </div>
            </div>
        </div>

        <!-- Partners Stats Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-gradient-to-r from-cyan-50 to-purple-50 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Partners</div>
                        <div class="text-3xl font-semibold text-gray-800">{{ $partnerCount }}</div>
                        <div class="text-gray-500 text-xs">Active Partnerships</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.partners') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        Manage Partners →
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.waitinglist') }}" class="bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-lg px-4 py-3 text-center font-medium hover:from-cyan-600 hover:to-cyan-700 transition duration-300">
                Manage Waiting List
            </a>
            <a href="{{ route('admin.stories') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg px-4 py-3 text-center font-medium hover:from-purple-600 hover:to-purple-700 transition duration-300">
                Add Success Story
            </a>
            <a href="{{ route('admin.partners') }}" class="bg-gradient-to-r from-cyan-500 to-purple-600 text-white rounded-lg px-4 py-3 text-center font-medium hover:from-cyan-600 hover:to-purple-700 transition duration-300">
                Add Partner
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">System Status</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                    <span class="text-gray-600">PHP Version</span>
                    <span class="text-gray-900 font-medium">{{ phpversion() }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                    <span class="text-gray-600">Laravel Version</span>
                    <span class="text-gray-900 font-medium">{{ app()->version() }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                    <span class="text-gray-600">Environment</span>
                    <span class="text-gray-900 font-medium">{{ app()->environment() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Server Time</span>
                    <span class="text-gray-900 font-medium">{{ now()->format('Y-m-d H:i:s') }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Activity</h2>
            <div class="text-gray-600 text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>Activity logging will be implemented in a future update.</p>
            </div>
        </div>
    </div>
</div>
