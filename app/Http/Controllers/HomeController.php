<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\Service;
use App\Models\Project;

use Illuminate\Http\Request;
use App\Http\Requests\PostMessageRequest;
use App\Models\Message;

class HomeController extends Controller
{
    private $service;

    private $activity;

    private $project;
    
    private $map = [
        'услуги' => 'service',
        'клиенти' => 'project',
        'дейности' => 'activitie'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service, Activity $activity, Project $project)
    {
        $this->service = $service;
        $this->activity = $activity;
        $this->project = $project;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', [
            'services' => Service::limit(4)->get(),
            'projects' => Project::get(),
            'activities' => Activity::limit(3)->get()
        ]);
    }

    public function services() {

        return view('company.services', ['entities' => Service::get()]);
    }

    public function projects() {
        return view('company.projects', ['entities' => Project::get()]);
    }

    public function activities() {
        return view('company.activities', ['entities' => Activity::get()]);
    }

    public function view(Request $request) {

        
        $entity = $this->map[$request->type];
        $model = $this->{$entity}
                ->where('slug', $request->slug)
                ->first();
      
        $featured = $this->{$entity}
            ->where('id', '!=', $model->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('company.view', ['entity' => $model, 'type' => $entity, 'featured' => $featured,  'breadcrumb' => '']);
    }

    public function post(PostMessageRequest $request) {
        $message = new Message();
        $message->create($request->all());
        return response()->json([
            'message' => 'Успешно запазване'
        ]);
    }
}
