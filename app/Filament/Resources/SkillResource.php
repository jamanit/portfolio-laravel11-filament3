<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
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

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

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
                TextInput::make('skill_name')
                    ->label('Skill Name')
                    ->placeholder('Enter Skill Name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Select::make('skill_level')
                    ->label('Level')
                    // ->placeholder('')
                    ->required()
                    ->options([
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced',
                        'Expert' => 'Expert',
                        'Master' => 'Master',
                    ]),
                Textarea::make('caption')
                    ->label('Caption')
                    ->placeholder('Enter Caption')
                    ->nullable()
                    ->string()
                    ->maxLength(5000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('skill_name')
                    ->label('Skill Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('skill_level')
                    ->label('Level')
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
            'index' => Pages\ListSkills::route('/'),
            // 'create' => Pages\CreateSkill::route('/create'),
            // 'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
