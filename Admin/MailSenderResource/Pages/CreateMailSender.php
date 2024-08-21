<?php

namespace Modules\MailSender\Admin\MailSenderResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Modules\MailSender\Admin\MailSenderResource;
use Modules\MailSender\Models\MailSender;

class CreateMailSender extends CreateRecord
{
    protected static string $resource = MailSenderResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return MailSender::query()->create([
            'subject' => $data['subject'],
            'additional' => $data['additional'],
            'addresses' => json_encode(isset($data['addresses']) ? explode(",", $data['addresses']) : []),
            'template' => $data['template'],
            'content' => $data['content'],
        ]);
    }
}
