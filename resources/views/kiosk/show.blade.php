<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LGU Aparri Public Kiosk</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=public-sans:400,500,600,700|merriweather:700,900" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-100 font-['Public_Sans'] text-slate-900 antialiased">
        <div class="min-h-screen bg-[linear-gradient(180deg,_#133b2f_0,_#133b2f_12rem,_#f5f5f4_12rem,_#f5f5f4_100%)] px-4 py-8 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <header class="rounded-2xl bg-white/95 p-6 shadow-sm">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-700">Public Attendance Kiosk</p>
                            <h1 class="mt-3 font-['Merriweather'] text-4xl font-black text-slate-900">LGU Aparri QR Attendance</h1>
                            <p class="mt-3 text-base text-slate-600">Scan or input the employee QR code for the currently active attendance event.</p>
                        </div>
                        <div class="rounded-xl border border-stone-300 bg-stone-50 px-5 py-4 text-sm text-slate-700">
                            @if ($activeEvent)
                                <p class="font-semibold uppercase tracking-[0.18em] text-emerald-700">Active Event</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $activeEvent->title }}</p>
                            @else
                                <p class="font-semibold uppercase tracking-[0.18em] text-amber-700">No Active Event</p>
                                <p class="mt-2 text-sm text-slate-700">An administrator must activate an attendance event before this kiosk can record entries.</p>
                            @endif
                        </div>
                    </div>
                </header>

                <main class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,0.95fr)_minmax(340px,1.05fr)]">
                    <section class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                        @if (session('status'))
                            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('kiosk.check-in') }}" class="space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="employee_id" :value="__('Employee ID / Scanned QR Value')" />
                                <x-text-input
                                    id="employee_id"
                                    name="employee_id"
                                    type="text"
                                    class="mt-2 block w-full text-lg"
                                    :value="old('employee_id')"
                                    :disabled="! $activeEvent"
                                    autofocus
                                    autocomplete="off"
                                    required
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('employee_id')" />
                            </div>

                            <div class="flex flex-wrap items-center gap-4">
                                <x-primary-button :disabled="! $activeEvent">
                                    {{ __('Record Attendance') }}
                                </x-primary-button>
                                <p class="text-sm text-slate-500">QR scanners that type into the input can submit this form directly with the employee ID value.</p>
                            </div>
                        </form>
                    </section>

                    <section class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-xl font-semibold text-slate-900">Recent kiosk activity</h2>
                        <div class="mt-6 space-y-4">
                            @forelse ($recentRecords as $recentRecord)
                                <article class="rounded-xl border border-stone-200 bg-stone-50 p-4">
                                    <p class="font-semibold text-slate-900">{{ $recentRecord->employee->name }}</p>
                                    <p class="mt-1 text-sm text-slate-600">{{ $recentRecord->employee->employee_id }} @if ($recentRecord->employee->office) · {{ $recentRecord->employee->office }} @endif</p>
                                    <p class="mt-2 text-sm text-slate-500">{{ $recentRecord->checked_in_at->format('M d, Y h:i:s A') }}</p>
                                </article>
                            @empty
                                <div class="rounded-xl border border-dashed border-stone-300 bg-stone-50 p-6 text-sm text-slate-500">
                                    No attendance has been recorded yet for the currently active event.
                                </div>
                            @endforelse
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </body>
</html>