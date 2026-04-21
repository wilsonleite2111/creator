<?php

namespace App\Filament\Resources\TendenciaResource\Pages;

use App\Filament\Resources\TendenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTendencias extends ManageRecords
{
    protected static string $resource = TendenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
