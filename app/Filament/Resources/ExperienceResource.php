<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Filament\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
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

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

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
                TextInput::make('job_title')
                    ->label('Job Title')
                    ->placeholder('Enter Job Title')
                    ->required()
                    ->string()
                    ->maxLength(255),
                TextInput::make('company_name')
                    ->label('Company Name')
                    ->placeholder('Enter Company Name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                TextInput::make('start_year')
                    ->label('Start Year')
                    ->placeholder('YYYY')
                    ->required()
                    ->type('number'),
                TextInput::make('end_year')
                    ->label('End Year')
                    ->placeholder('YYYY')
                    ->nullable()
                    ->type('number'),
                RichEditor::make('job_description')
                    ->label('Job Description')
                    ->placeholder('Enter Job Description')
                    ->nullable()
                    ->string()
                    ->maxLength(3000)
                    ->columnSpan('full')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'redo',
                        'undo',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_title')
                    ->label('Job Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('company_name')
                    ->label('Company Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_year')
                    ->label('Start Year')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_year')
                    ->label('End Year')
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
