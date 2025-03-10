<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Exports\UserExporter;
use Filament\Tables\Actions\ExportAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ViewColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon  = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Data Masters';
    protected static ?int $navigationSort     = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Enter Name')
                    ->required()
                    ->string()
                    ->maxLength(50),
                TextInput::make('username')
                    ->label('Username')
                    ->placeholder('Enter Username')
                    ->required()
                    ->string()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true)
                    ->hidden(fn(string $context): bool => $context === 'create'),
                TextInput::make('email')
                    ->label('Email')
                    ->placeholder('Enter Email')
                    ->required()
                    ->string()
                    ->maxLength(100)
                    ->email()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->placeholder('Enter Password')
                    ->password()
                    ->required(fn(string $context): bool => $context === 'create')
                    ->string()
                    ->minLength(6)
                    ->dehydrated(fn($state) => !empty($state))
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->placeholder('Enter Confirm Password')
                    ->password()
                    ->required(fn(string $context): bool => $context === 'create')
                    ->string()
                    ->minLength(6)
                    ->dehydrated(fn($state) => !empty($state)),
                Select::make('roles')
                    ->label('Roles')
                    // ->placeholder('')
                    ->nullable()
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable(),
                FileUpload::make('profile_picture')
                    ->label('Profile Picture')
                    ->placeholder('')
                    ->nullable()
                    ->image()
                    ->directory('users')
                    ->disk('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->maxSize(5048)
                    ->deleteUploadedFileUsing(function ($file, $record) {
                        Storage::disk('public')->delete($file);

                        $record->update([
                            'profile_picture' => null,
                        ]);
                    }),
                RichEditor::make('bio')
                    ->label('Bio')
                    ->placeholder('Enter Bio')
                    ->nullable()
                    ->string()
                    ->maxLength(2000)
                    ->columnSpan('full')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'redo',
                        'undo',
                    ]),
                TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->placeholder('Enter Phone Number')
                    ->nullable()
                    ->numeric()
                    ->type('tel')
                    ->tel(),
                TextInput::make('whatsapp_number')
                    ->label('WhatsApp Number')
                    ->placeholder('Enter WhatsApp Number')
                    ->nullable()
                    ->numeric()
                    ->type('tel')
                    ->tel(),
                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->placeholder('Enter LinkedIn URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
                TextInput::make('github_url')
                    ->label('GitHub URL')
                    ->placeholder('Enter GitHub URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
                TextInput::make('facebook_url')
                    ->label('Facebook URL')
                    ->placeholder('Enter Facebook URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
                TextInput::make('instagram_url')
                    ->label('Instagram URL')
                    ->placeholder('Enter Instagram URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
                TextInput::make('x_url')
                    ->label('X URL')
                    ->placeholder('Enter X URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
                TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->placeholder('Enter YouTube URL')
                    ->nullable()
                    ->string()
                    ->maxLength(255),
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
                TextColumn::make('username')
                    ->label('Username')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('profile_picture')
                    ->label('Profile Picture')
                    ->width(50)
                    ->height(50)
                    ->sortable()
                    ->searchable(),
                ViewColumn::make('portfolio')
                    ->label('Portfolio')
                    ->view('components.view-portfolio-button'),
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
                ExportAction::make()
                    ->exporter(UserExporter::class)
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
