<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Service
 *
 * @author Vesaka
 */
class Activity extends Model{
    public $type = 'activity';
    
    protected $fillable = [
        'name', 'description', 'slug', 'crop_data', 'filename'
    ];
}
