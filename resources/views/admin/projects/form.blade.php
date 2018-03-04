@extends('adminlte::page')

@include('admin.templates.form', [
    'model' => isset($project) ? $project : null,
    'entity' => 'project',
    'title' => isset($project->id) ? ucfirst($project->name) : 'Нов Обект'
])
