<?php

namespace App\Filament\Penyewa\Resources;

use App\Filament\Penyewa\Resources\SchedulesResource\Pages;
use App\Filament\Penyewa\Resources\SchedulesResource\RelationManagers;
use App\Models\Schedules;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SchedulesResource extends Resource
{
    protected static ?string $model = Schedules::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getEloquentQuery(): Builder
    {
        //hanya jadwal booking untuk properti milik penyewa
        return parent::getEloquentQuery()
            ->whereHas('booking', function ($q) {
                $q->whereHas('property', function ($q2) {
                    $q2->where('penyewa_id', Auth::id());
                });
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Schedule Info')
                    ->schema([
                        Forms\Components\TextInput::make('booking.property.name')
                            ->label('Property')
                            ->disabled(),
                        Forms\Components\TextInput::make('booking.customer.name')
                            ->label('Customer')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('start_date')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'booked' => 'Booked',
                                'completed' => 'Completed'
                            ])
                            ->disabled(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('booking.property.name')->label('Property')->searchable(),
                Tables\Columns\TextColumn::make('booking.customer.name')->label('Customer')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->dateTime(),
                Tables\Columns\TextColumn::make('end_date')->dateTime(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'booked',
                        'success' => 'completed',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'booked' => 'Booked',
                        'completed' => 'Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('complete')
                    ->label('Mark as Completed')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'booked')
                    ->action(function ($record) {
                        $record->update(['status' => 'completed']);

                        // update status booking juga
                        if ($record->booking) {
                            $record->booking->update(['status' => 'completed']);
                        }

                        Notification::make()
                            ->success()
                            ->title('Schedule marked as completed')
                            ->send();
                    }),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchedules::route('home'),
            // 'edit'  => Pages\EditSchedules::route('/{record}/edit'),
        ];
    }
}
