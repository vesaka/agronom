<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Description of BaseController
 *
 * @author Vesaka
 */
abstract class BaseController extends Controller {

    CONST DEFAULT_FILENAME = 'default.jpg';

    protected $basepath = '/resources/assets/img/';

    public function index() {
        return view(sprintf('%s.list', $this->route), ['entities' => $this->model->get(), 'type' => $this->model->type]);
    }

    public function create() {
        return view(sprintf('%s.form', $this->route));
    }

    public function store(PostRequest $request) {
        $model = $this->model->where('slug', str_slug($request->title))->first();

        if (!is_null($model)) {
            $request->id = $model->id;
            $this->update($request);
            return;
        }
        
        $imageName = '';
        if ($request->hasFile('image')) {

            $imageName = str_slug($request->title) . '_' . time() . '.' . $request->image->getClientOriginalExtension();


            $request->image->move(base_path("resources/assets/img/$this->entity/original"), $imageName);
            $crop_data = json_decode($request->crop_data);
            Image::make(base_path("resources/assets/img/$this->entity/original/$imageName"))
                    ->crop($crop_data->width, $crop_data->height, $crop_data->x, $crop_data->y)
                    ->save(base_path("resources/assets/img/$this->entity/$imageName"));
        }
        $this->model->create([
            'name' => $request->title,
            'description' => $request->description,
            'slug' => str_slug($request->title),
            'crop_data' => $request->crop_data,
            'filename' => $imageName
        ]);

        dd($request->all());
    }

    public function update(PostRequest $request) {
        $entity = $this->model->find($request->id);

        $storage = Storage::disk('images');
        $filename = base_path("/resources/assets/img/$this->entity/$entity->filename");
        //dd($storage->exists(base_path("resources/assets/img/$this->entity")), base_path("resources/assets/img/$this->entity"));
        $_original = "/activity/original/$entity->filename";
        $original = $storage->exists($_original) ? $_original : $filename;

        $crop_data = json_decode(isset($request->crop_data) ? $request->crop_data : $entity->crop_data);
        $imageName = $entity->filename;

        $update = true;

        if ($request->image instanceof UploadedFile) {
            $imageName = $entity->name . '_' . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(base_path("/resources/assets/img/$this->entity/original/"), $imageName);
            $original = base_path("/resources/assets/img/$this->entity/original/$imageName");
        } else if (
                isset($request->crop_data) && $request->crop_data !== $entity->crop_data && $entity->filename !== self::DEFAULT_FILENAME
        ) {
            $update = false;
        }

        if ($update) {
            Image::make($original)
                    ->crop($crop_data->width, $crop_data->height, $crop_data->x, $crop_data->y)
                    ->save(base_path("resources/assets/img/$this->entity/$imageName"));

            $storage->delete([$filename, $_original]);
        }
        $entity->filename = $imageName;

        $entity->save();
    }

    public function edit(Request $request) {
        $entity = $this->model->find($request->id);
        return view(sprintf('%s.form', $this->route), [$this->entity => $entity]);
    }

    public function view(Request $request) {
        $this->model->find($request->id);
        return view(sprintf('%s.view', $this->route), [$this->entity => $entity]);
    }

    public function remove(Request $request) {
        $this->model->find($request->id)->delete();
    }

    public function respondWithJson($data) {
        $options = app('request')->header('accept-charset') == 'utf-8' ? JSON_UNESCAPED_UNICODE : null;

        return response()->json($data, 200, $options);
    }

}
