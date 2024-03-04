<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ServiceExport implements FromCollection , WithHeadings,WithTitle
{
        /**
     * @return Collection
     */
    public function collection()
    {
        $services = Service::select("nom", "description")->get();

        // Remove HTML tags from the description field
        $services->transform(function ($service) {
            $service->description = strip_tags($service->description);
            return $service;
        });

        return $services;
    }

    public function headings(): array
    {
        return ["Nom", "Description"];
    }
    public function title(): string
    {
        return 'Prestation';
    }

}
