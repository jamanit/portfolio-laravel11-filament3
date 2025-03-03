<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
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

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Data Masters';
    protected static ?int $navigationSort = 8;

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
                TextInput::make('client_name')
                    ->label('Client Name')
                    ->placeholder('Enter Client Name')
                    ->required()
                    ->string()
                    ->maxLength(255),
                FileUpload::make('client_image')
                    ->label('Client Image')
                    ->placeholder('')
                    ->nullable()
                    ->image()
                    ->directory('testimonials')
                    ->disk('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        Storage::disk('public')->delete($file);

                        $record->update([
                            'client_image' => null,
                        ]);
                    }),
                RichEditor::make('testimonial_text')
                    ->label('Testimonial Text')
                    ->placeholder('Enter Testimonial Text')
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
                TextColumn::make('client_name')
                    ->label('Client Name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('client_image')
                    ->label('Client Image')
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
            'index' => Pages\ListTestimonials::route('/'),
            // 'create' => Pages\CreateTestimonial::route('/create'),
            // 'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
