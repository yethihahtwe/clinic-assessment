<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('User Name and Email')
                ->schema([TextInput::make('name')->label('Username')->placeholder('Please enter Username')->required()->maxLength(255)->columnSpan(1), TextInput::make('email')->placeholder('Please enter email')->required()->email()->maxLength(255)->unique(ignoreRecord: true)->columnSpan(1), Select::make('organization_id')->relationship(name: 'organization', modifyQueryUsing: fn(Builder $query) => $query->orderBy('name')->orderBy('abbr'))->getOptionLabelFromRecordUsing(fn(Organization $record) => "{$record->name} ({$record->abbr})")->placeholder('Please select organization')->searchable()->preload()->live()->native(false)->required()->columnSpan(2)])
                ->columns(4),
            Section::make('Password')
                ->schema([TextInput::make('password')->placeholder('Please enter password')->confirmed()->helperText('Please enter a password of at least 8 characters')->password()->revealable()->required(fn($livewire) => $livewire instanceof CreateUser)->maxLength(255)->rule(Password::default())->dehydrated(fn($state) => filled($state))->dehydrateStateUsing(fn($state) => Hash::make($state)), TextInput::make('password_confirmation')->label(__('Confirm password'))->placeholder('Please confirm password')->password()->dehydrated(false)->revealable()->required(fn($livewire) => $livewire instanceof CreateUser)])
                ->columns(2),
            Section::make('Admin')
                ->schema([Toggle::make('is_admin')->label(__('Make this user an admin.')),]),
            Section::make('Profile Information')
                ->schema([
                    TextInput::make('position')->placeholder('Please enter position')->required(fn(string $context): bool => $context === 'edit')->maxLength(255)->columnSpan(3),
                    Select::make('country_code')
                        ->placeholder('Select')
                        ->options(['+66' => 'Thailand (+66)', '+95' => 'Myanmar (+95)'])
                        ->live()
                        ->native(false)
                        ->columnSpan(1),
                    TextInput::make('phone')
                        ->prefix(function (Get $get) {
                            return match ($get('country_code')) {
                                '+66' => '+66',
                                '+95' => '+95',
                                default => null,
                            };
                        })
                        ->suffixIcon('heroicon-o-device-phone-mobile')
                        ->placeholder('Please enter phone number')
                        ->maxLength(255)
                        ->tel()
                        ->columnSpan(2),
                    FileUpload::make('avatar')->avatar()->imageEditor()->directory('avatars'),
                ])
                ->columns(6)
                ->hidden(fn($livewire) => $livewire instanceof CreateUser),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('organization.name')->label('Organization')->searchable()->sortable(),
                TextColumn::make('organization.abbr')->label('Abbreviation')
	                ->formatStateUsing(fn(string $state):string => '(' . $state . ')')
	                ->searchable()->sortable(),
								TextColumn::make('is_admin')
									->label('Role')
									->formatStateUsing(fn(bool $state):string => $state ? 'Admin' : 'User')
									->badge()
									->color(fn(bool $state):string => $state ? 'success' : 'warning'),
                TextColumn::make('created_at')->date(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
