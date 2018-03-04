<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Models\Service;
/**
 * Description of ServiceController
 *
 * @author Vesaka
 */
class ServiceController extends BaseController {

    protected $route = 'admin.services.';

    protected $entity = 'service';

    protected $model;

    public function __construct(Service $service) {
        $this->model = $service;
    }

}
