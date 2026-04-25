<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee QR Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Create employee QR profile</h3>
                    <p class="mt-2 text-sm text-gray-600">Employees do not have their own login accounts. Admins create a QR profile for printing or electronic distribution.</p>
                </div>

                <form method="POST" action="{{ route('employees.store') }}" class="grid gap-6 p-6 md:grid-cols-3">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Employee Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="office" :value="__('Office')" />
                        <x-text-input id="office" name="office" type="text" class="mt-1 block w-full" :value="old('office')" />
                        <x-input-error class="mt-2" :messages="$errors->get('office')" />
                    </div>

                    <div>
                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                        <x-text-input id="employee_id" name="employee_id" type="text" class="mt-1 block w-full" :value="old('employee_id')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('employee_id')" />
                    </div>

                    <div class="md:col-span-3">
                        <x-primary-button>
                            {{ __('Save Employee QR Profile') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>

            <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Registered employees</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.18em] text-gray-500">Name</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.18em] text-gray-500">Office</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.18em] text-gray-500">Employee ID</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-[0.18em] text-gray-500">QR</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($employees as $employee)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $employee->office ?: '—' }}</td>
                                    <td class="px-6 py-4 font-mono text-gray-700">{{ $employee->employee_id }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('employees.qr.show', $employee) }}" class="text-emerald-700 underline underline-offset-4">Open printable QR</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">No employee QR profiles have been created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>