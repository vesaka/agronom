<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Message
 *
 * @author Vesaka
 */
class Message extends Model {

    protected $table = 'messages';
    
    protected $fillable = ['subject', 'text', 'name', 'email', 'unread'];
}
