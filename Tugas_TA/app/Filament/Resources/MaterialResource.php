<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Materi'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(true)
                            ->required(),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->label('Isi Materi (Teori)'),
                    ])->columns(2),


                Forms\Components\Section::make('Praktik & Compiler')
                    ->description('Aktifkan compiler agar murid bisa langsung mencoba koding di samping materi.')
                    ->schema([
                        Forms\Components\Toggle::make('has_compiler')
                            ->label('Aktifkan Compiler')
                            ->reactive()
                            ->default(false),
                        Forms\Components\Toggle::make('has_flowchart')
                            ->label('Aktifkan Latihan Flowchart')
                            ->default(false),
                        Forms\Components\Select::make('language')
                            ->options([
                                'html' => 'HTML/Live Preview',
                                'javascript' => 'JavaScript (Node.js)',
                                'php' => 'PHP',
                                'python' => 'Python',
                                'java' => 'Java',
                                'csharp' => 'C# (Mono)',
                                'c' => 'C',
                                'cpp' => 'C++',
                                'go' => 'Go',
                                'rust' => 'Rust',
                                'kotlin' => 'Kotlin',
                                'swift' => 'Swift',
                                'typescript' => 'TypeScript',
                                'sql' => 'SQL',
                                'ruby' => 'Ruby',
                            ])
                            ->required(fn (Forms\Get $get) => $get('has_compiler'))
                            ->visible(fn (Forms\Get $get) => $get('has_compiler'))
                            ->label('Bahasa Pemrograman'),
                        Forms\Components\Textarea::make('sample_code')
                            ->label('Kode Awal (Sample Code)')
                            ->rows(12)
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'font-family: monospace; font-size: 13px; background-color: #0f172a; color: #f8fafc; tab-size: 4;'])
                            ->placeholder('Masukkan kode awal yang bisa dicoba oleh murid...')
                            ->visible(fn (Forms\Get $get) => $get('has_compiler')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language')
                    ->label('Compiler')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->formatStateUsing(fn ($state) => $state ? strtoupper($state) : 'OFF')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
