<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\RelationManagers\ServicesRelationManager;
use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers\JobsRelationManager;
use App\Models\Department;
use App\Models\Service;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('department')
                        ->label('Users Department ID')
                        ->required()
                        ->default(
                            Auth::user()->department_id
                        )
                        ->disabled(),
                        // ->options([
                        //     Department::pluck('name', 'id')
                        // ]),
                    Forms\Components\TextInput::make('user')
                        ->label('ICT OFFICER WORK ID')
                        ->default(Auth::user()->id)
                        ->required()
                        ->disabled(),
                    Forms\Components\TextInput::make('reportedBy')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telephone')
                        ->tel()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('designation')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('fault')
                        ->required()
                        ->options([
                            'Hardware/Software/Technical' => 'Hardware/Software/Technical',
                            'Networks/Wireless' => 'Networks/Wireless',
                            'Other: Please Specify' => 'Other: Please Specify'
                        ]),
                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->maxLength(65535),
                ])->columns(2)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reportedBy'),
                Tables\Columns\TextColumn::make('telephone'),
                Tables\Columns\TextColumn::make('designation'),
                Tables\Columns\TextColumn::make('fault'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Time Reported')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('department')->label('Ministry'),
                Tables\Columns\TextColumn::make('user')->label('ICT Officer'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            JobsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }    
}
