<?php

namespace App\Filament\Penyewa\Resources;

use App\Filament\Penyewa\Resources\PropertyImagesResource\Pages;
use App\Filament\Penyewa\Resources\PropertyImagesResource\RelationManagers;
use App\Models\PropertyImages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PropertyImagesResource extends Resource
{
    protected static ?string $model = PropertyImages::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Relasi & Media')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->label('Properti')
                            ->relationship(
                                name: 'property',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query) =>
                                $query->where('penyewa_id', Auth::id())
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Create: multi upload
                        Forms\Components\FileUpload::make('images')
                            ->label('Foto Properti')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->openable()
                            ->downloadable()
                            ->directory(fn(Get $get) => $get('property_id')
                                ? "properties/{$get('property_id')}"
                                : "properties")
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(4096)
                            ->required()
                            ->columnSpanFull()
                            ->visibleOn('create'), // hanya muncul di Create

                        // Edit: single upload
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Foto Properti')
                            ->image()
                            ->openable()
                            ->downloadable()
                            ->directory(fn(Get $get) => $get('property_id')
                                ? "properties/{$get('property_id')}"
                                : "properties")
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(4096)
                            ->required()
                            ->columnSpanFull()
                            ->visibleOn('edit'), // hanya muncul di Edit
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->label('Properti')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPropertyImages::route('/'),
            'create' => Pages\CreatePropertyImages::route('/create'),
            'edit' => Pages\EditPropertyImages::route('/{record}/edit'),
        ];
    }
}
