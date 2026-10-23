<?php

namespace App\Filament\Resources\ClinicAppointmentResource\Pages;

use App\Filament\Resources\ClinicAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClinicAppointments extends ListRecords
{
    protected static string $resource = ClinicAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
