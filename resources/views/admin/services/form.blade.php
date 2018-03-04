@extends('adminlte::page')

@include('admin.templates.form', [
    'model' => isset($service) ? $service : null,
    'entity' => 'service',
    'title' => isset($service->id) ? ucfirst($service->name) : 'Нова Услуга'
])

