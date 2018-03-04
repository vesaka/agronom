<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index() {
        return view('admin.contacts.index');
    }

    public function edit() {
        return view('admin.contacts.form');
    }

    public function update(Request $request) {
        return response();
    }
}
