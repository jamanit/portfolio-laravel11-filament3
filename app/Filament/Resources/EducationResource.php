<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Filament\Resources\EducationResource\RelationManagers;
use App\Models\Education;
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

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Data Masters';
    protected static ?int $navigationSort = 2;

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
                TextInput::make('school_name')
                    ->label('School Name')
                    ->placeholder('Enter School Name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                Select::make('degree')
                    ->label('Degree')
                    // ->placeholder('')
                    ->required()
                    ->options([
                        'SD (Elementary)'         => 'SD (Elementary)',
                        'SMP (Junior High)'       => 'SMP (Junior High)',
                        'SMA (Senior High)'       => 'SMA (Senior High)',
                        'Diploma'                 => 'Diploma',
                        'S1 (Bachelor\'s Degree)' => 'S1 (Bachelor\'s Degree)',
                        'S2 (Master\'s Degree)'   => 'S2 (Master\'s Degree)',
                        'S3 (Doctoral Degree)'    => 'S3 (Doctoral Degree)',
                    ]),
                TextInput::make('gpa')
                    ->label('GPA')
                    ->placeholder('Enter GPA (e.g., 3.50)')
                    ->numeric()
                    ->minValue(0.00)
                    ->maxValue(4.00)
                    ->step(0.01)
                    ->nullable(),
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
                RichEditor::make('description')
                    ->label('Description')
                    ->placeholder('Enter Description')
                    ->nullable()
                    ->string()
                    ->maxLength(500)
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
                TextColumn::make('school_name')
                    ->label('School Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('degree')
                    ->label('Degree')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('gpa')
                    ->label('GPA')
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
            'index'  => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit'   => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
