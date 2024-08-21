<?php

namespace Modules\MailSender\Admin\MailSenderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\MailSender\Admin\MailSenderResource;

class ListMailSenders extends ListRecords
{
    protected static string $resource = MailSenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
