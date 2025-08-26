<?php

namespace App\Filament\Penyewa\Resources;

use App\Filament\Penyewa\Resources\BookingsResource\Pages;
use App\Models\Bookings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BookingsResource extends Resource
{
    protected static ?string $model = Bookings::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Transactions';
    public static function getNavigationBadge(): ?string
    {
        // Hitung booking dengan status 'pending_payment' dan milik properti penyewa yang login
        $count = Bookings::where('status', 'pending_payment')
            ->whereHas('property', function ($query) {
                $query->where('penyewa_id', Auth::id());
            })
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    // Hanya tampilkan booking milik penyewa yang login
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('property', function ($query) {
                $query->where('penyewa_id', Auth::id());
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Booking Info')
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->label('Property')
                            ->relationship('property', 'name') // relasi di model
                            ->disabled(),

                        Forms\Components\Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'name')
                            ->disabled(),
                        Forms\Components\DatePicker::make('start_date')->disabled(),
                        Forms\Components\DatePicker::make('end_date')->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending_payment' => 'Pending Payment',
                                'confirmed'       => 'Confirmed',
                                'cancelled'       => 'Cancelled',
                                'completed'       => 'Completed',
                            ])
                            ->disabled(),
                    ]),

                Forms\Components\Section::make('Payment Verification')
                    ->schema([
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'verified'  => 'Verified',
                                'rejected'  => 'Rejected',
                                'cancelled' => 'Cancelled',
                            ])
                            ->reactive(), // penting agar perubahan langsung bereaksi
                        Forms\Components\TextInput::make('payment.remark')
                            ->label('Remark')
                            ->visible(fn(callable $get) => in_array($get('payment_status'), ['rejected', 'cancelled']))
                            ->required(fn(callable $get) => in_array($get('payment_status'), ['rejected', 'cancelled'])),
                        Forms\Components\ViewField::make('proof_image')
                            ->label('Proof Image')
                            ->view('components.proof-image'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('property.name')->label('Property'),
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending_payment',
                        'success' => 'confirmed',
                        'danger'  => 'cancelled',
                        'gray'    => 'completed',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending_payment' => 'Pending Payment',
                        'confirmed'       => 'Confirmed',
                        'cancelled'       => 'Cancelled',
                        'completed'       => 'Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBookings::route('/create'),
            'edit'   => Pages\EditBookings::route('/{record}/edit'),
        ];
    }
}
