<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <h2 class="text-lg font-bold mb-4">Daftar Subscriber ({{ count($subscribers) }})</h2>
            @if(count($subscribers) > 0)
            <div class="overflow-x-auto rounded-lg border">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800">
                            <th class="px-4 py-3 text-left font-medium">Email</th>
                            <th class="px-4 py-3 text-left font-medium">Bergabung</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-4 py-3">{{ $subscriber['email'] }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($subscriber['subscribed_at'])->translatedFormat('d M Y, H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-500">Belum ada subscriber.</p>
            @endif
        </div>

        <div>
            <h2 class="text-lg font-bold mb-4">Kirim Newsletter</h2>
            <form wire:submit="send">
                {{ $this->form }}
                <div class="mt-6 flex justify-end">
                    <x-filament::button type="submit" icon="heroicon-o-paper-airplane">
                        Kirim Newsletter
                    </x-filament::button>
                </div>
            </form>
        </div>
    </div>
</x-filament-panels::page>
