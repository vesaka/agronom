<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Service
 *
 * @author Vesaka
 */
class Service extends Model{
    
    public $type = 'service';
    
    protected $fillable = [
        'name', 'description', 'slug', 'crop_data', 'filename'
    ];
}
