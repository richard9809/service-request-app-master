<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers\JobsRelationManager;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('department_id')
                        ->label('Users Department ID')
                        ->required()
                        ->default(
                            Auth::user()->department_id
                        )
                        ->disabled(),
                        // ->options([
                        //     Department::pluck('name', 'id')
                        // ]),
                    Forms\Components\TextInput::make('user_id')
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

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reportedBy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone'),
                Tables\Columns\TextColumn::make('fault'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Time Reported')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('user')->label('ICT Officer'),

            ])
            ->filters([
                SelectFilter::make('fault')
                    ->label('Category of Fault')
                    ->multiple()
                    ->options([
                        'Hardware/Software/Technical' => 'Hardware/Software/Technical',
                        'Networks/Wireless' => 'Networks/Wireless',
                        'Other: Please Specify' => 'Other: Please Specify'
                    ]),
                SelectFilter::make('user')->relationship('user', 'name'),
                SelectFilter::make('department')->relationship('department', 'name'),
                Filter::make('created_at')
                        ->form([
                            DatePicker::make('created_from'),
                            DatePicker::make('created_until'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['created_from'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('services.created_at', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn (Builder $query, $date): Builder => $query->whereDate('services.created_at', '<=', $date),
                                );
                        })
                        ->indicateUsing(function (array $data): array {
                            $indicators = [];
                    
                            if ($data['from'] ?? null) {
                                $indicators['from'] = 'Created from ' . Carbon::parse($data['from'])->toFormattedDateString();
                            }
                    
                            if ($data['until'] ?? null) {
                                $indicators['until'] = 'Created until ' . Carbon::parse($data['until'])->toFormattedDateString();
                            }
                    
                            return $indicators;
                        }),

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
