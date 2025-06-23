<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use App\Filament\Resources\BookingTransactionResource;
use App\Models\WorkshopParticipant;
use DB;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookingTransaction extends CreateRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function afterCreate(): void
    {
        \DB::transaction(function () {
            $record = $this->record;
            $participants = $this->form->getState()['participants'] ?? [];

            foreach ($participants as $participant) {
                \App\Models\WorkshopParticipant::create([
                    'workshop_id' => $record->workshop_id,
                    'booking_transaction_id' => $record->id,
                    'name' => $participant['name'],
                    'occupation' => $participant['occupation'],
                    'email' => $participant['email'],
                ]);
            }
        });
    }
}