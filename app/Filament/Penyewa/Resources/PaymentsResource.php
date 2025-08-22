<?php

namespace App\Filament\Penyewa\Resources;

use App\Filament\Penyewa\Resources\PaymentsResource\Pages;
use App\Filament\Penyewa\Resources\PaymentsResource\Pages\EditPayments;
use App\Filament\Penyewa\Resources\PaymentsResource\Pages\ViewPayments;
use App\Filament\Penyewa\Resources\PaymentsResource\RelationManagers;
use App\Models\Payments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PaymentsResource extends Resource
{
    protected static ?string $model = Payments::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getEloquentQuery(): Builder
    {
        // Hanya tampilkan payment untuk booking yang properti nya dimiliki penyewa yang login
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
                Forms\Components\Section::make('Payment Info')
                    ->schema([
                        Forms\Components\TextInput::make('booking_id')->label('Booking ID')->disabled(),
                        Forms\Components\TextInput::make('booking.property.name')->label('Property')->disabled(),
                        Forms\Components\TextInput::make('booking.customer.name')->label('Customer')->disabled(),
                        Forms\Components\TextInput::make('amount')->label('Amount')->disabled()->numeric(),
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'pending_verification' => 'Pending Verification',
                                'verified'             => 'Verified',
                                'rejected'             => 'Rejected',
                                'cancelled'            => 'Cancelled',
                            ]),
                        Forms\Components\DateTimePicker::make('payment_due_date')->disabled(),
                        Forms\Components\FileUpload::make('proof_image')
                            ->label('Proof Image')
                            ->directory('payments')
                            ->disk('public')
                            ->image()
                            ->disabled(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('booking.property.name')->label('Property')->searchable(),
                Tables\Columns\TextColumn::make('booking.customer.name')->label('Customer')->searchable(),
                Tables\Columns\TextColumn::make('amount')->money('idr', true),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->colors([
                        'warning' => 'pending_verification',
                        'success' => 'verified',
                        'danger'  => 'rejected',
                        'gray'    => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('payment_due_date')->dateTime(),
                Tables\Columns\ImageColumn::make('proof_image')
                    ->disk('public')
                    ->label('Proof')
                    ->toggleable(false)
                    ->rounded(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'pending_verification' => 'Pending Verification',
                        'verified'             => 'Verified',
                        'rejected'             => 'Rejected',
                        'cancelled'            => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->modalHeading('Payment Details')
                    ->modalButton('Close')
                // Tables\Actions\Action::make('verify')
                //     ->label('Verify')
                //     ->icon('heroicon-o-check')
                //     ->requiresConfirmation()
                //     ->action(function (Payments $record, array $data = null) {
                //         // safety: cek kondisi
                //         if ($record->payment_status === 'verified') {
                //             Notification::make()->warning('Payment already verified.')->send();
                //             return;
                //         }

                //         $record->update(['payment_status' => 'verified']);

                //         // update booking jika ada
                //         if ($record->booking) {
                //             $record->booking->update(['status' => 'confirmed']);
                //         }

                //         Notification::make()->success('Payment verified.')->send();
                //     }),

                // Tables\Actions\Action::make('reject')
                //     ->label('Reject')
                //     ->icon('heroicon-o-x-circle')
                //     ->requiresConfirmation()
                //     ->action(function (Payments $record) {
                //         if ($record->payment_status === 'rejected') {
                //             Notification::make()->warning('Payment already rejected.')->send();
                //             return;
                //         }

                //         $record->update(['payment_status' => 'rejected']);

                //         // set booking cancelled & hapus schedule jika ada
                //         if ($record->booking) {
                //             $record->booking->update(['status' => 'cancelled']);
                //             // hapus schedule yang terkait (safe check)
                //             if ($record->booking->schedule()) {
                //                 $record->booking->schedule()->delete();
                //             }
                //         }

                //         Notification::make()->success('Payment rejected & booking cancelled.')->send();
                //     }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('home'),
            // 'view'  => Pages\ViewPayments::route('/{record}/view')
            // 'create' => Pages\CreatePayments::route('/create'),
            // 'edit' => Pages\EditPayments::route('/{record}/edit'),
        ];
    }
}
