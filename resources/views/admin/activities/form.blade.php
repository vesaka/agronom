@extends('adminlte::page')
@include('admin.templates.form', [
    'model' => isset($activity) ? $activity : null,
    'entity' => 'activity',
    'title' => isset($activity->id) ? ucfirst($activity->name) : 'Нова Дейност'
])
