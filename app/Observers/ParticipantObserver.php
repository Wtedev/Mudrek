<?php

namespace App\Observers;

use App\Models\Participant;
use App\Models\ProgramActivityLog;

class ParticipantObserver
{
    public function created(Participant $participant): void
    {
        ProgramActivityLog::logRegistration((string) $participant->full_name);
    }

    public function updated(Participant $participant): void
    {
        if (
            $participant->wasChanged('checked_in_at')
            && $participant->getOriginal('checked_in_at') === null
            && $participant->checked_in_at !== null
        ) {
            ProgramActivityLog::logCheckedIn((string) $participant->full_name);
        }
    }

    public function deleting(Participant $participant): void
    {
        ProgramActivityLog::logDeleted((string) $participant->full_name);
    }
}
