<x-filament::page>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($this->getRecords() as $record)
        <x-filament::card>
            <div class="text-lg font-semibold text-primary">
                {{ $record->farmer->name }}
            </div>

            <div class="text-sm text-gray-500">
                <strong>Disease:</strong> {{ $record->disease->name }}
            </div>

            <div class="text-sm text-gray-500">
                <strong>Severity:</strong>
                <span class="capitalize">{{ $record->severity }}</span>
            </div>

            <div class="text-sm text-gray-500">
                <strong>Location:</strong> {{ $record->village->name }}
            </div>

            <div class="mt-2">
                <x-filament::button tag="a" href="{{ route('filament.admin.resources.disease-reports.view', $record) }}">
                    View Details
                </x-filament::button>
            </div>
        </x-filament::card>
        @endforeach
    </div>
</x-filament::page>