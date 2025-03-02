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

class ExperiencesRelationManager extends RelationManager
{
    protected static string $relationship = 'experiences';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                TextInput::make('start_date')
                    ->label('Start Date')
                    ->placeholder('')
                    ->required()
                    ->type('date'),
                TextInput::make('end_date')
                    ->label('End Date')
                    ->placeholder('')
                    ->nullable()
                    ->type('date'),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('job_title')
            ->columns([
                TextColumn::make('job_title')
                    ->label('Job Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('company_name')
                    ->label('Company Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_date')
                    ->label('End Date')
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
