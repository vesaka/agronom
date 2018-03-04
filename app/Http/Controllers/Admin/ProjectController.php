<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Models\Project;

/**
 * Description of ProjectController
 *
 * @author Vesaka
 */
class ProjectController extends BaseController {

    protected $route = 'admin.projects.';

    protected $entity = 'project';

    protected $model;

    public function __construct(Project $project) {
        $this->model = $project;
    }

}
