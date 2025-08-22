<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bookings;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\BookingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingResource\RelationManagers;

class BookingResource extends Resource
{
    protected static ?string $model = Bookings::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Transactions';
    protected static ?int $navigationSort = 3;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->label('Property'),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending_payment',
                        'success' => 'confirmed',
                        'danger'  => 'cancelled',
                        'gray'    => 'completed',
                    ]),
                Tables\Columns\TextColumn::make('payment.payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending_verification'   => 'warning',
                        'verified'      => 'success',
                        'rejected'    => 'danger',
                        'cancelled'     => 'gray',
                }),

                    
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending_payment' => 'Pending Payment',
                        'confirmed'       => 'Confirmed',
                        'cancelled'       => 'Cancelled',
                        'completed'       => 'Completed',
                    ]),
                Tables\Filters\SelectFilter::make('payment.payment_status')
                    ->label('Payment Status')
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
                    ->modalHeading('Booking Details')
                    ->infolist([
                        TextEntry::make('property.name')->label('Property'),
                        TextEntry::make('customer.name')->label('Customer'),
                        TextEntry::make('start_date')->date(),
                        TextEntry::make('end_date')->date(),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state) => match ($state) {
                                'pending_payment' => 'warning',
                                'confirmed'       => 'success',
                                'cancelled'       => 'danger',
                                'completed'       => 'gray',
                            }),
                        TextEntry::make('payment.payment_status')
                            ->label('Payment Status')
                            ->badge()
                            ->color(fn (string $state) => match ($state) {
                                'pending_verification' => 'warning',
                                'verified'       => 'success',
                                'rejected'       => 'danger',
                                'cancelled'       => 'gray',
                            })
                    ])
                    ->modalCancelActionLabel('Close'),
                
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
            'index' => Pages\ListBookings::route('/'),
            // 'create' => Pages\CreateBooking::route('/create'),
            // 'view' => Pages\ViewBooking::route('/{record}'),
            // 'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
