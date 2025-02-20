<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
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

use function PHPSTORM_META\type;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

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
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Enter Name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->placeholder('Enter Email')
                    ->required()
                    ->type('email')
                    ->maxLength(255),
                Textarea::make('message')
                    ->label('Message')
                    ->placeholder('Enter Message')
                    ->required()
                    ->string()
                    ->maxLength(5000),
                Select::make('status')
                    ->label('Status')
                    // ->placeholder('')
                    ->required()
                    ->options([
                        'Pending' => 'Pending',
                        'Read'    => 'Read',
                        'Replied' => 'Replied',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
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
            'index'  => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit'   => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
