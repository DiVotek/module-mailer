<?php

namespace Modules\MailSender\Models;

use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSender extends Model
{
    use HasFactory;
    use HasTable;
    use HasTimestamps;

    protected $fillable = ['subject', 'status', 'additional', 'template', 'addresses', 'content'];

    protected $casts = ['addresses' => 'array'];

    public static function getDb(): string
    {
        return 'mail_senders';
    }
}
