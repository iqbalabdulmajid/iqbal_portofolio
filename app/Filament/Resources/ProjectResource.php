<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card untuk layout yang lebih rapi
                \Filament\Forms\Components\Section::make('Informasi Proyek')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                        RichEditor::make('description')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('projects/attachments') // Folder khusus lampiran gambar di dalam teks
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Media & Link')
                    ->schema([
                        FileUpload::make('image')
                            ->image() // Validasi hanya gambar
                            ->directory('projects') // Folder penyimpanan di storage/app/public
                            ->visibility('public')
                            ->imageEditor(), // Fitur crop gambar langsung di browser!

                        TextInput::make('tech_stack')
                            ->placeholder('Contoh: Laravel, Tailwind, Livewire'),

                        TextInput::make('link_github')
                            ->url(),

                        TextInput::make('link_demo')
                            ->url(),

                        Toggle::make('is_published')
                            ->label('Publish ke Website?')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'), // Menampilkan thumbnail proyek

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tech_stack')
                    ->badge() // Membuat tampilan seperti label/tag
                    ->separator(','),

                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
