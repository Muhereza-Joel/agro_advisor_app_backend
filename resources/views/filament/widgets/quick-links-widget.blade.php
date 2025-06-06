<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">Quick Links</h2>

        <ul class="space-y-6">
            <li>
                <a href="{{ route('filament.dashboard.resources.questions.index') }}" class="text-primary-600 hover:underline">
                    ➤ Ask Question
                </a>
            </li>
            <li>
                <a href="{{ route('filament.dashboard.resources.disease-reports.create') }}" class="text-primary-600 hover:underline">
                    ➤ Report Disease
                </a>
            </li>
            <li>
                <a href="{{ route('filament.dashboard.resources.knowledge.index') }}" class="text-primary-600 hover:underline">
                    ➤ Livestock Management Articles
                </a>
            </li>
            <li>
                <a href="{{ route('filament.dashboard.resources.diseases.index') }}" class="text-primary-600 hover:underline">
                    ➤ Livistock Diseases
                </a>
            </li>
            <li>
                <a href="{{ route('filament.dashboard.resources.disease-categories.index') }}" class="text-primary-600 hover:underline">
                    ➤ All Disease Categories
                </a>
            </li>

        </ul>
    </x-filament::card>
</x-filament::widget>