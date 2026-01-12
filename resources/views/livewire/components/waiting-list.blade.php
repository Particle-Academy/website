<div  class="bg-white rounded-lg shadow-md p-8 border-t-4 border-gradient-to-r from-cyan-400 to-purple-600">
    <div class="mb-6">
        
        @if (session()->has('message'))
            <div class="bg-cyan-50 border border-cyan-400 text-cyan-700 px-4 py-3 rounded relative mb-4">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <form wire:submit.prevent="submit" class="max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">
        <div class="text-gray-700 text-lg leading-relaxed">
            <p class="mb-6 flex flex-wrap items-center gap-2">
                Hi, I'm 
                <span class="inline-block">
                    <input type="text" 
                        wire:model.lazy="name" 
                        class="w-40 border-b-2 border-cyan-300 focus:border-purple-500 focus:ring-0 bg-transparent px-1" 
                        placeholder="your name">
                    <flux:error name="name" />
                </span>, 
                
                you can email me at 
                <span class="inline-block">
                    <input type="email" 
                        wire:model.lazy="email" 
                        class="w-56 border-b-2 border-cyan-300 focus:border-purple-500 focus:ring-0 bg-transparent px-1" 
                        placeholder="your@email.com">
                    <flux:error name="email" />
                </span> 
                
                and I am interested in 
                <span class="inline-block">
                    {{-- <flux:select 
                        variant="listbox" 
                        multiple 
                        indicator="checkbox"
                        wire:model="interest"
                        selected-suffix="topics"
                        placeholder="select topics...">
                        @foreach($interestOptions as $option)
                            <flux:select.option value="{{ $option }}">{{ $option }}</flux:select.option>
                        @endforeach
                    </flux:select> --}}
                    <select wire:model="interest" multiple class="border-b-2 border-cyan-300 focus:border-purple-500 focus:ring-0 bg-transparent px-1 h-10">
                        @foreach($interestOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <flux:error name="interest" />
                </span>.
            </p>
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-purple-600 hover:from-cyan-600 hover:to-purple-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                Join Waiting List
            </button>
        </div>
    </form>
</div>
