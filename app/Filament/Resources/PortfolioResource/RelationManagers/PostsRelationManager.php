<?php

namespace App\Filament\Resources\PortfolioResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ViewColumn;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    // ->placeholder('')
                    ->options(function (RelationManager $livewire): array {
                        return $livewire->getOwnerRecord()->categories()
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    // ->relationship('category', 'name')
                    ->nullable()
                    ->preload()
                    ->searchable(),
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Enter Title')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    // ->placeholder('')
                    ->required()
                    ->options([
                        'Publish'    => 'Publish',
                        'Inpublish'  => 'Inpublish',
                    ]),
                FileUpload::make('image')
                    ->label('Image')
                    ->placeholder('')
                    ->nullable()
                    ->image()
                    ->directory('posts')
                    ->disk('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        Storage::disk('public')->delete($file);

                        $record->update([
                            'image' => null,
                        ]);
                    }),
                RichEditor::make('description')
                    ->label('Description')
                    ->placeholder('Enter Description')
                    ->nullable()
                    ->string()
                    ->maxLength(5000)
                    ->columnSpan('full')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('/posts/description'),
                Textarea::make('labels')
                    ->label('Labels')
                    ->placeholder('Enter labels separated by commas (e.g., Tech, Web, Design)')
                    ->helperText('Type labels separated by commas.')
                    ->nullable()
                    ->regex('/^[a-zA-Z0-9\s,]+$/')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_view')
                    ->label('Total VIew')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Image')
                    ->width(50)
                    ->height(50)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Owner')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
