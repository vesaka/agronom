<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
/**
 * Description of MessageController
 *
 * @author Vesaka
 */
class MessageController extends Controller {
    
    public function index() {
        return view('admin.messages.list');
    }
}
