<?php

namespace App\Filament\Widgets;

use App\Models\Participant;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ParticipantOverviewWidget extends StatsOverviewWidget
{
    protected ?string $heading = null;

    protected int|string|array $columnSpan = 'full';

    /**
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        $total = Participant::query()->count();
        $attended = Participant::query()->whereNotNull('checked_in_at')->count();

        return [
            Stat::make('عدد المسجلين', number_format($total))
                ->description('إجمالي السجلات في النظام')
                ->icon(Heroicon::OutlinedUserGroup)
                ->color('primary'),
            Stat::make('عدد الحضور', number_format($attended))
                ->description('من لديهم وقت تحضير مسجّل')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success'),
        ];
    }
}
