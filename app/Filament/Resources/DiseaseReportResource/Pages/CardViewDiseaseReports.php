<?php

use App\Filament\Resources\DiseaseReportResource;
use Filament\Resources\Pages\Page;
use App\Models\DiseaseReport;

class CardViewDiseaseReports extends Page
{
    protected static string $resource = DiseaseReportResource::class;

    protected static string $view = 'filament.resources.disease-report-resource.pages.card-view-disease-reports';

    public function getRecords()
    {
        return DiseaseReport::with(['farmer', 'disease', 'village'])->latest()->get();
    }
}
