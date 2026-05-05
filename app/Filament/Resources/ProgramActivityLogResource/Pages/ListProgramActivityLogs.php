<?php

namespace App\Filament\Resources\ProgramActivityLogResource\Pages;

use App\Filament\Resources\ProgramActivityLogResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListProgramActivityLogs extends ListRecords
{
    protected static string $resource = ProgramActivityLogResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'سجل العمليات';
    }
}
