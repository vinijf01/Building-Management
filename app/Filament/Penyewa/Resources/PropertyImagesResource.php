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
use Filament\Tables\Grouping\Group;

class PropertyImagesResource extends Resource
{
    protected static ?string $model = PropertyImages::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Properties';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Relasi & Media')
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('property_id')
                            ->label('Property')
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
                            ->label('IMage Property')
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
                            ->label('Image Properti')
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
            ->groups([
                Group::make('property.name')
                    ->collapsible(), // ✅ bikin collapse/expand
            ])
            ->defaultGroup('property.name')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Properties')
                    ->size(120),
            ])
            ->filters([])
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
            'index' => Pages\ListPropertyImages::route('home'),
            'create' => Pages\CreatePropertyImages::route('/create'),
            'edit' => Pages\EditPropertyImages::route('/{record}/edit'),
        ];
    }
}
