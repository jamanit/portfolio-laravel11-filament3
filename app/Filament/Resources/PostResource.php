<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    // ->placeholder('')
                    ->required()
                    ->options(
                        User::all()->pluck('name', 'id')->toArray()
                    )
                    ->preload()
                    ->searchable(),
                Select::make('category_id')
                    ->label('Category')
                    // ->placeholder('')
                    ->nullable()
                    ->relationship('category', 'name')
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

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label('User')
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
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
