<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use App\Models\Service;
use Barryvdh\DomPDF\PDF;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\RedirectResponse;

use function PHPUnit\Framework\returnSelf;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 2;

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('eqptName')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('serial')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('model')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('summary')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('remarks')
                        ->required()
                        ->maxLength(255),
                    Select::make('service')
                        ->required()
                        ->label('Reported By')
                        ->options(Service::all()->pluck('reportedBy', 'id'))
                        ->searchable(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Job No.'),
                Tables\Columns\TextColumn::make('user')->label('ICT Officer'),
                Tables\Columns\TextColumn::make('reportedBy')->label('Reported By')
                    ->searchable(),
                Tables\Columns\TextColumn::make('summary'),
                Tables\Columns\TextColumn::make('eqptName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),

            ])
            ->filters([
                SelectFilter::make('user')->relationship('user', 'name'),
                Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from'),
                    DatePicker::make('created_until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('jobs.created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('jobs.created_at', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('pdf')
                        ->icon('heroicon-o-document')
                        ->url(fn (Job $record): string => route('job-pdf', ['job' => $record]))
                        ->openUrlInNewTab(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }    
}
