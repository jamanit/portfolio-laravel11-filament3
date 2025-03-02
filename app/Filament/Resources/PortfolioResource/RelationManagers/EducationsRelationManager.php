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

class EducationsRelationManager extends RelationManager
{
    protected static string $relationship = 'educations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('school_name')
            ->columns([
                TextColumn::make('school_name')
                    ->label('School Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('degree')
                    ->label('Degree')
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
