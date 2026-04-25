<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-700">Employees</p>
                        <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $employeeCount }}</p>
                        <p class="mt-2 text-sm text-gray-600">Registered employee QR profiles available for printing or e-QR distribution.</p>
                    </div>
                </section>

                <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-700">Attendance Events</p>
                        <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $eventCount }}</p>
                        <p class="mt-2 text-sm text-gray-600">Events the admin can activate for the public kiosk attendance flow.</p>
                    </div>
                </section>

                <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-700">Active Event</p>
                        @if ($activeEvent)
                            <p class="mt-3 text-xl font-semibold text-gray-900">{{ $activeEvent->title }}</p>
                            <p class="mt-2 text-sm text-gray-600">{{ $activeEvent->attendance_records_count }} attendance record(s) captured for the current kiosk event.</p>
                        @else
                            <p class="mt-3 text-xl font-semibold text-gray-900">No active event</p>
                            <p class="mt-2 text-sm text-gray-600">Create and activate an event so the public kiosk can start receiving attendance check-ins.</p>
                        @endif
                    </div>
                </section>
            </div>

            <div class="grid gap-6 lg:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
                <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Attendance Activity</h3>
                        <p class="mt-2 text-sm text-gray-600">Latest kiosk check-ins recorded against the active and previous attendance events.</p>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse ($recentRecords as $recentRecord)
                            <div class="flex flex-col gap-2 p-6 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $recentRecord->employee->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $recentRecord->employee->employee_id }} @if ($recentRecord->employee->office) · {{ $recentRecord->employee->office }} @endif</p>
                                </div>
                                <div class="text-sm text-gray-600 sm:text-right">
                                    <p class="font-medium text-gray-900">{{ $recentRecord->attendanceEvent->title }}</p>
                                    <p>{{ $recentRecord->checked_in_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-sm text-gray-600">
                                No attendance records have been captured yet.
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Access</h3>
                    </div>

                    <div class="space-y-4 p-6">
                        <a href="{{ route('employees.index') }}" class="block rounded-lg border border-gray-200 p-4 transition hover:border-emerald-300 hover:bg-emerald-50">
                            <p class="font-semibold text-gray-900">Manage Employee QR Profiles</p>
                            <p class="mt-2 text-sm text-gray-600">Create employee records and open printable QR pages for physical or electronic distribution.</p>
                        </a>
                        <a href="{{ route('attendance.events.index') }}" class="block rounded-lg border border-gray-200 p-4 transition hover:border-amber-300 hover:bg-amber-50">
                            <p class="font-semibold text-gray-900">Manage Attendance Events</p>
                            <p class="mt-2 text-sm text-gray-600">Create attendance events and choose which one is active for the public kiosk.</p>
                        </a>
                        <a href="{{ route('kiosk.show') }}" class="block rounded-lg border border-gray-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                            <p class="font-semibold text-gray-900">Open Public Kiosk</p>
                            <p class="mt-2 text-sm text-gray-600">Use this screen at the attendance station where employee QR codes will be scanned.</p>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
