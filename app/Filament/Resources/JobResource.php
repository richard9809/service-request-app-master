<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Filament\Resources\JobResource\RelationManagers\ServicesRelationManager;
use App\Filament\Resources\ServiceResource\RelationManagers\JobsRelationManager;
use App\Models\Job;
use App\Models\Service;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Filament\Forms;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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

    public static function downloadPdf($id)
    {
        $job = Job::leftJoin('users', 'jobs.user_id', '=', 'users.id')
                ->leftJoin('services', 'jobs.service_id', '=', 'services.id')
                ->leftJoin('departments', 'services.department', '=', 'departments.id')
                ->select('jobs.*', 'services.reportedBy as reportedBy', 'services.telephone as telephone', 'users.name as ICT')
                ->findOrFail($id)
                ->first();

        $pdf = PDF::loadView('pdf.job-details', compact('job'));
        return $pdf->download("job-details-{$job->id}.pdf");
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Job No.'),
                Tables\Columns\TextColumn::make('user')->label('ICT Officer'),
                Tables\Columns\TextColumn::make('reportedBy')->label('Reported By'),
                Tables\Columns\TextColumn::make('summary'),
                Tables\Columns\TextColumn::make('eqptName'),
                Tables\Columns\TextColumn::make('serial'),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('pdf')
                        ->icon('heroicon-o-document')
                        ->url(fn (Job $record): string => route('job-pdf', ['job' => $record]))
                        ->openUrlInNewTab()
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
