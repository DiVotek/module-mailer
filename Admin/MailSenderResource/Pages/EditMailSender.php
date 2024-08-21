<?php

namespace Modules\MailSender\Admin\MailSenderResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Modules\MailSender\Admin\MailSenderResource;

class EditMailSender extends EditRecord
{
    protected static string $resource = MailSenderResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['addresses'] = !empty(json_decode($data['addresses'])) ? implode(",", json_decode($data['addresses'], true)) : '';
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update([
            'subject' => $data['subject'],
            'additional' => $data['additional'],
            'addresses' => json_encode(isset($data['addresses']) ? explode(",", $data['addresses']) : []),
            'template' => $data['template'],
            'content' => $data['content'],
        ]);
        return $record;
    }
}
