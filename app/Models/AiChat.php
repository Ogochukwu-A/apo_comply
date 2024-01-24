<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiChat extends Model
{
    use HasFactory;

    public $fillable = ['chat_id','user_id','model','object','prompt_tokens','completion_tokens','total_tokens','system_fingerprint','index','role','content','logprobs','finish_reason','search_term'];

    public $table = 'ai_chats';
}
