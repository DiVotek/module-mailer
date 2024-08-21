<?php

namespace Modules\MailSender\Admin;

use App\Models\Newsletter;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use Modules\MailSender\Admin\MailSenderResource\Pages;
use Modules\MailSender\Models\MailSender;

class MailSenderResource extends Resource
{
    protected static ?string $model = MailSender::class;

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Communication');
    }

    public static function getModelLabel(): string
    {
        return __('MailSender');
    }

    public static function getPluralModelLabel(): string
    {
        return __('MailSenders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Schema::getSubject()
                            ->required(),
                        Schema::getAdditional(),
                        Schema::getAddresses(),
                        Schema::getMailsTemplate(),
                        Schema::getContent()
                            ->required()
                            ->helperText(__('Main content of the mail.')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getSubject(),
                TableSchema::getAdditional()
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        return $record->additional ? __('Additional') : __('All');
                    }),
                TableSchema::getLabelStatus()
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        return $record->status ? __('Sent') : __('Not sent');
                    }),
                TableSchema::getUpdatedAt(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('send')
                    ->label(__('Send'))
                    ->action(function (MailSender $record) {
                        $addresses = $record->additional ? json_decode($record->addresses) ?? [] : Newsletter::pluck('email')->toArray() ?? [];

                        foreach ($addresses as $address) {
                            Mail::send('mail-sender::mails.base', [
                                'content' => $record->content,
                                'subject' => $record->subject,
                            ], function ($message) use ($record, $address) {
                                $message->to($address)->subject($record->subject);
                            });
                        }

                        $record->update(['status' => true]);

                        Notification::make()
                            ->title(__('Email(s) sent successfully!'))
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make(__('Help'))
                    ->iconButton()
                    ->icon('heroicon-o-question-mark-circle')
                    ->modalDescription(__('Here you can manage blog categories. Blog categories are used to group blog articles. You can create, edit and delete blog categories as you want. Blog category will be displayed on the blog page or inside slider(modules section). If you want to disable it, you can do it by changing the status of the blog category.'))
                    ->modalFooterActions([]),
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
            'index' => Pages\ListMailSenders::route('/'),
            'create' => Pages\CreateMailSender::route('/create'),
            'edit' => Pages\EditMailSender::route('/{record}/edit'),
        ];
    }
}
