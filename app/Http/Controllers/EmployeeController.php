<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EmployeeController extends Controller
{
    public function index(): View
    {
        return view('admin.employees.index', [
            'employees' => Employee::query()
                ->orderBy('office')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        Employee::query()->create($request->validated());

        return redirect()
            ->route('employees.index')
            ->with('status', 'Employee QR profile created successfully.');
    }

    public function showQr(Employee $employee): View
    {
        return view('admin.employees.qr', [
            'employee' => $employee,
            'qrSvg' => new HtmlString(
                QrCode::format('svg')
                    ->size(360)
                    ->margin(1)
                    ->generate($employee->qrPayload())
            ),
        ]);
    }
}