<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Models\Participant;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationLabel = 'تحضير المشاركين';

    protected static ?string $modelLabel = 'مشارك';

    protected static ?string $pluralModelLabel = 'المسجلين';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQrCode;

    protected static string|UnitEnum|null $navigationGroup = 'إدارة البرنامج';

    protected static ?int $navigationSort = 20;

    public static function getSlug(?Panel $panel = null): string
    {
        return 'attendance-scanner';
    }

    public static function canViewAny(): bool
    {
        return auth()->check();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->check();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            'pending' => 'قيد الانتظار',
            'completed' => 'مكتمل التسجيل',
            'reviewed' => 'تمت المراجعة',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            'waitlisted' => 'قائمة انتظار',
            'acceptance_sent' => 'أُرسل القبول',
            'attended' => 'حضر',
            'absent' => 'غائب',
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('الاسم')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('national_id')
                    ->label('الهوية')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('mobile')
                    ->label('الجوال')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('nationality')
                    ->label('الجنسية')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('education_stage')
                    ->label('المرحلة')
                    ->toggleable(),
                TextColumn::make('gender')
                    ->label('الجنس')
                    ->toggleable(),
                TextColumn::make('region')
                    ->label('المنطقة')
                    ->toggleable(),
                TextColumn::make('commitment_status')
                    ->label('الالتزام')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('referral_source')
                    ->label('المصدر')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): ?string => static::statusOptions()[$state] ?? $state),
                TextColumn::make('attendance_label')
                    ->label('الحضور')
                    ->badge()
                    ->sortable(false)
                    ->color(fn (Participant $record): string => $record->checked_in_at ? 'success' : 'gray')
                    ->getStateUsing(fn (Participant $record): string => $record->checked_in_at ? 'حضر' : 'لم يحضر'),
                TextColumn::make('checked_in_at')
                    ->label('وقت التحضير')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('—'),
                IconColumn::make('has_viewed_program_details')
                    ->label('اطّلاع')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاريخ التسجيل')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('q')
                    ->label('بحث شامل')
                    ->form([
                        TextInput::make('value')
                            ->label('بحث في الاسم، الجوال، البريد، الهوية')
                            ->placeholder('اكتب للبحث…'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $v = trim((string) ($data['value'] ?? ''));
                        if ($v === '') {
                            return $query;
                        }

                        return $query->where(function (Builder $q) use ($v): void {
                            $q->where('full_name', 'like', "%{$v}%")
                                ->orWhere('mobile', 'like', "%{$v}%")
                                ->orWhere('email', 'like', "%{$v}%")
                                ->orWhere('national_id', 'like', "%{$v}%");
                        });
                    }),
                TernaryFilter::make('attended')
                    ->label('الحضور')
                    ->placeholder('الكل')
                    ->trueLabel('حضر')
                    ->falseLabel('لم يحضر')
                    ->queries(
                        true: fn (Builder $q) => $q->whereNotNull('checked_in_at'),
                        false: fn (Builder $q) => $q->whereNull('checked_in_at'),
                        blank: fn (Builder $q) => $q,
                    ),
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options(static::statusOptions()),
                SelectFilter::make('region')
                    ->label('المنطقة')
                    ->options(fn (): array => Participant::query()
                        ->whereNotNull('region')
                        ->distinct()
                        ->orderBy('region')
                        ->pluck('region', 'region')
                        ->filter()
                        ->all()),
                SelectFilter::make('gender')
                    ->label('الجنس')
                    ->options(fn (): array => Participant::query()
                        ->whereNotNull('gender')
                        ->distinct()
                        ->pluck('gender', 'gender')
                        ->filter()
                        ->all()),
                SelectFilter::make('education_stage')
                    ->label('المرحلة الدراسية')
                    ->options(fn (): array => Participant::query()->distinct()->orderBy('education_stage')->pluck('education_stage', 'education_stage')->all()),
                SelectFilter::make('nationality')
                    ->label('الجنسية')
                    ->options([
                        'سعودي' => 'سعودي',
                        'غير سعودي' => 'غير سعودي',
                    ]),
            ])
            ->recordActions([
                Action::make('checkIn')
                    ->label('تحضير')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->modalHeading(fn (Participant $record): string => 'هل تريد تحضير '.$record->full_name.'؟')
                    ->modalSubmitActionLabel('تحضير')
                    ->modalCancelActionLabel('إلغاء')
                    ->requiresConfirmation()
                    ->action(function (Participant $record): void {
                        $record->update([
                            'status' => 'attended',
                            'checked_in_at' => now(),
                        ]);
                    })
                    ->hidden(fn (Participant $record): bool => $record->checked_in_at !== null),
            ])
            ->defaultSort('id', 'desc')
            ->recordTitleAttribute('full_name')
            ->recordAction(null);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipants::route('/'),
        ];
    }
}
