<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Models\Activity;

/**
 * Description of ProjectController
 *
 * @author Vesaka
 */
class ActivityController extends BaseController {

    protected $route = 'admin.activities.';

    protected $entity = 'activity';

    protected $model;

    public function __construct(Activity $activity) {
        $this->model = $activity;
    }

}
