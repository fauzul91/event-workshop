<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Workshop;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\BookingTransaction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Product and Price')
                        ->schema([
                            Select::make('workshop_id')
                                ->relationship('workshop', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $workshop = Workshop::find($state);
                                    $set('price', $workshop ? $workshop->price : 0);
                                }),

                            TextInput::make('price')
                                ->hidden()
                                ->default(0)
                                ->dehydrated(false),

                            TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->prefix('By People')
                                ->live()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $price = $get('price') ?? 0;
                                    $subTotal = $price * $state;
                                    $totalPpn = $subTotal * 0.12;
                                    $totalAmount = $subTotal + $totalPpn;

                                    $set('total_amount', $totalAmount);

                                    $participants = $get('participants') ?? [];
                                    $currentCount = count($participants);

                                    if ($state > $currentCount) {
                                        for ($i = $currentCount; $i < $state; $i++) {
                                            $participants[] = ['name' => '', 'occupation' => '', 'email' => ''];
                                        }
                                    } else {
                                        $participants = array_slice($participants, 0, $state);
                                    }

                                    $set('participants', $participants);
                                })

                                ->afterStateHydrated(function ($state, callable $get, callable $set) {
                                    $price = $get('price');
                                    $subTotal = $price * $state;
                                    $totalPpn = $subTotal * 0.12;
                                    $totalAmount = $subTotal + $totalPpn;

                                    $set('total_amount', $totalAmount);
                                }),
                            TextInput::make('total_amount')
                                ->default(fn($record) => $record?->total_amount)
                                ->required()
                                ->numeric()
                                ->prefix('IDR')
                                ->readOnly()
                                ->helperText('Harga sudah include PPN 12%'),

                            Repeater::make('participants')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('name')->label('Participant Name')->required(),
                                            TextInput::make('occupation')->label('Occupation')->required(),
                                            TextInput::make('email')->label('Email')->required(),
                                        ]),
                                ])
                                ->columns(1)
                                ->label('Participant Details'),
                        ]),

                    Step::make('Customer Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customer_bank_name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customer_bank_account')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('customer_bank_number')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('booking_trx_id')
                                ->required()
                                ->maxLength(255),
                        ]),
                    Step::make('Payment Information')
                        ->schema([
                            ToggleButtons::make('is_paid')
                                ->label('Apakah sudah membayar?')
                                ->boolean()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock'
                                ])
                                ->required(),
                            FileUpload::make('proof')
                                ->image()
                                ->required(),
                        ])
                ])
                    ->columnSpanFull()
                    ->columns(1)
                    ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('workshop.thumbnail'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('booking_trx_id')->searchable(),
                TextColumn::make('total_amount'),
                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseicon('heroicon-o-x-circle')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => !$record->is_paid) // hanya tampil kalau belum dibayar
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_paid' => true]);
                    }),
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
