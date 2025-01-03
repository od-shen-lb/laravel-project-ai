<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Lang;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = '管理員管理';

    protected static ?string $breadcrumb = '管理員管理';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('姓名')->required()->maxLength(255),
                TextInput::make('email')->email()->required()->maxLength(255)->unique(ignoreRecord: true),

                Select::make('roles')
                    ->label('角色')
                    ->required()
                    ->relationship('roles', 'name')
                    ->saveRelationshipsWhenDisabled(true) // Enable saving relationships when disabled
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('姓名'),
                TextColumn::make('email'),
                TextColumn::make('roles.name')->label('角色')->sortable(),
                TextColumn::make('created_at')->label('建立時間')->dateTime('Y/m/d H:i')->sortable(),
                TextColumn::make('updated_at')->label('更新時間')->dateTime('Y/m/d H:i')->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return Lang::get('Admin Model');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }
}
