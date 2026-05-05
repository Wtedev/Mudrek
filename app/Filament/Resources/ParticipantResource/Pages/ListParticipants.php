<?php

namespace App\Filament\Resources\ParticipantResource\Pages;

use App\Exports\ParticipantsExport;
use App\Filament\Resources\ParticipantResource;
use App\Filament\Widgets\ParticipantOverviewWidget;
use App\Models\ProgramActivityLog;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Components\RenderHook;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;
use Maatwebsite\Excel\Facades\Excel;

class ListParticipants extends ListRecords
{
    protected static string $resource = ParticipantResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'تحضير المشاركين';
    }

    public function shouldSelectCurrentPageOnly(): bool
    {
        return true;
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('sendEmail')
                        ->label('إرسال بريد (BCC)')
                        ->icon(Heroicon::OutlinedEnvelope)
                        ->color('primary')
                        ->schema([
                            TextInput::make('subject')
                                ->label('عنوان الرسالة')
                                ->default('رسالة من مدرك 4')
                                ->maxLength(255),
                            Textarea::make('body')
                                ->label('نص الرسالة (اختياري)')
                                ->rows(4),
                        ])
                        ->action(function (BulkAction $action): void {
                            $records = $action->getSelectedRecords();
                            $emails = $records->pluck('email')->filter(fn (?string $e): bool => filled($e))->unique()->values()->all();
                            if ($emails === []) {
                                Notification::make()
                                    ->title('لا يوجد بريد')
                                    ->body('المحدّدون لا يملكون عناوين بريد صالحة.')
                                    ->warning()
                                    ->send();

                                return;
                            }

                            $data = $action->getData();
                            $bcc = implode(',', $emails);
                            $subject = rawurlencode((string) ($data['subject'] ?? 'رسالة من مدرك 4'));
                            $body = rawurlencode((string) ($data['body'] ?? ''));
                            $href = 'mailto:?bcc='.rawurlencode($bcc).'&subject='.$subject.'&body='.$body;

                            if (strlen($href) > 1800) {
                                Notification::make()
                                    ->title('الرابط طويل جداً')
                                    ->body('قلّل عدد المحدّدين أو أرسل على دفعات.')
                                    ->danger()
                                    ->send();

                                return;
                            }

                            ProgramActivityLog::logEmailSent(count($emails));

                            $action->getLivewire()->js('window.location.href = '.json_encode($href));
                        }),
                    DeleteBulkAction::make()
                        ->label('حذف المحدّدين'),
                ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Livewire::make(ParticipantOverviewWidget::class),
                RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE),
                EmbeddedTable::make(),
                RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('تصدير إكسل')
                ->icon(Heroicon::OutlinedArrowDownTray)
                ->color('gray')
                ->action(function () {
                    $query = $this->getTableQueryForExport();

                    return Excel::download(
                        new ParticipantsExport($query),
                        'al-musajilin-'.now()->format('Y-m-d_His').'.xlsx',
                    );
                }),
            Action::make('openQrScanner')
                ->label('امسح رمز QR للتحضير')
                ->icon(Heroicon::OutlinedQrCode)
                ->color('primary')
                ->url(route('admin.attendance-scan')),
        ];
    }
}
