<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Service
 *
 * @author Vesaka
 */
class Project extends Model{
    public $type = 'project';
    
    protected $fillable = [
        'name', 'description', 'slug', 'crop_data', 'filename'
    ];
}
