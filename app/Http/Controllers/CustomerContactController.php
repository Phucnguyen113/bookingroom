<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\CustomerContactServiceContract;

class CustomerContactController extends Controller
{
    public function __construct(protected CustomerContactServiceContract $customerContactService)
    {

    }

    public function index()
    {
        $data = $this->customerContactService->customerContacts();

        return view('customerContacts.index', compact('data'));
    }
}
