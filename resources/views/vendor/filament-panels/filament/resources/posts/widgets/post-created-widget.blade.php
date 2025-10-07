<x-filament-widgets::widget>
    <x-filament::section>
        <div
            x-data
            x-init="
                Echo.channel('posts')
                    .listen('PostCreated', (e) => {
                        Livewire.dispatch('post-created');
                    });
            "
        >
            <div class="text-sm text-gray-600">🔊 Listening for new posts...</div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
