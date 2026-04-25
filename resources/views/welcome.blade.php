<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LGU Aparri QR Attendance</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=merriweather:400,700,900|public-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#edf4ff] font-['Public_Sans'] text-slate-900 antialiased">
        <div class="min-h-screen bg-[linear-gradient(180deg,_#dce9ff_0%,_#f8fbff_14rem,_#eff5ff_14rem,_#eff5ff_100%)]">
            <div class="border-b border-[#0b347a] bg-[#0f3d91] text-blue-50">
                <div class="mx-auto flex max-w-7xl flex-col gap-2 px-6 py-3 text-xs font-semibold uppercase tracking-[0.22em] sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <p>Republic of the Philippines</p>
                    <p>Local Government Unit of Aparri, Cagayan</p>
                </div>
            </div>

            <header class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
                <div class="flex flex-col gap-6 border-b border-blue-200 pb-8 lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex items-center gap-5">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full border-4 border-[#0f3d91]/15 bg-white text-center font-['Merriweather'] text-sm font-black uppercase tracking-[0.24em] text-[#0f3d91] shadow-sm">
                            LGU
                        </div>
                        <div>
                            <p class="font-['Merriweather'] text-3xl font-black text-[#0f3d91]">LGU Aparri</p>
                            <p class="mt-1 text-sm font-medium uppercase tracking-[0.2em] text-slate-600">QR Attendance Administration and Kiosk Access</p>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex flex-wrap items-center gap-3 text-sm font-semibold">
                            @auth
                                <a
                                    href="{{ route('dashboard') }}"
                                    class="inline-flex items-center rounded-md border border-[#0f3d91] bg-[#0f3d91] px-4 py-2 text-white transition hover:bg-[#0b347a]"
                                >
                                    Admin Dashboard
                                </a>
                                <a
                                    href="{{ route('kiosk.show') }}"
                                    class="inline-flex items-center rounded-md border border-blue-200 bg-white px-4 py-2 text-slate-700 transition hover:bg-blue-50"
                                >
                                    Public Kiosk
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center rounded-md border border-[#0f3d91] bg-[#0f3d91] px-4 py-2 text-white transition hover:bg-[#0b347a]"
                                >
                                    Admin Login
                                </a>
                                <a
                                    href="{{ route('kiosk.show') }}"
                                    class="inline-flex items-center rounded-md border border-blue-200 bg-white px-4 py-2 text-slate-700 transition hover:bg-blue-50"
                                >
                                    Open Kiosk
                                </a>
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-16 lg:px-8 lg:pb-24">
                <section class="grid gap-6 xl:grid-cols-[minmax(0,1.15fr)_380px]">
                    <article class="rounded-[1.75rem] border border-blue-200 bg-[linear-gradient(180deg,_#ffffff_0%,_#f3f8ff_100%)] p-8 shadow-sm sm:p-10">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-[#0f3d91]">Municipal Attendance Portal</p>
                        <h1 class="mt-5 max-w-4xl font-['Merriweather'] text-4xl font-black leading-tight text-slate-900 sm:text-5xl">
                            QR attendance management for LGU Aparri.
                        </h1>
                        <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-700">
                            Administrators prepare employee QR codes, assign the current attendance event, and operate a public kiosk for check-in. Employees do not need login accounts because attendance is handled through their printed or electronic QR codes.
                        </p>

                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            @auth
                                <a
                                    href="{{ route('employees.index') }}"
                                    class="inline-flex items-center rounded-md bg-[#2563c9] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1f57b0]"
                                >
                                    Manage Employee QRs
                                </a>
                                <a
                                    href="{{ route('attendance.events.index') }}"
                                    class="inline-flex items-center rounded-md border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50"
                                >
                                    Set Attendance Event
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center rounded-md bg-[#0f3d91] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#0b347a]"
                                >
                                    Enter Admin Console
                                </a>
                                <a
                                    href="{{ route('kiosk.show') }}"
                                    class="inline-flex items-center rounded-md border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-blue-50"
                                >
                                    Launch Public Kiosk
                                </a>
                            @endauth
                        </div>

                        <div class="mt-10 grid gap-4 md:grid-cols-3">
                            <article class="border-l-4 border-[#0f3d91] bg-white/90 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Administration</p>
                                <p class="mt-2 font-['Merriweather'] text-2xl font-bold text-slate-900">Admin Only</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Only authorized administrators can manage employees, events, and QR issuance.</p>
                            </article>
                            <article class="border-l-4 border-[#2563c9] bg-white/90 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Employee QR</p>
                                <p class="mt-2 font-['Merriweather'] text-2xl font-bold text-slate-900">ID-Based</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Each QR encodes the official employee ID and nothing more.</p>
                            </article>
                            <article class="border-l-4 border-[#5b8fdd] bg-white/90 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Attendance</p>
                                <p class="mt-2 font-['Merriweather'] text-2xl font-bold text-slate-900">Event-Based</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">The public kiosk records attendance against the single active event chosen by the admin.</p>
                            </article>
                        </div>
                    </article>

                    <aside class="space-y-5">
                        <section class="rounded-[1.75rem] border border-blue-200 bg-white p-6 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#0f3d91]">Administrative Console</p>
                            <h2 class="mt-3 font-['Merriweather'] text-2xl font-bold text-slate-900">What admins handle</h2>
                            <ul class="mt-5 space-y-4 text-sm leading-6 text-slate-700">
                                <li class="border-b border-blue-100 pb-4">Create employee QR profiles for printing or e-QR distribution.</li>
                                <li class="border-b border-blue-100 pb-4">Choose which event currently needs attendance.</li>
                                <li>Review recent attendance activity from the kiosk screen.</li>
                            </ul>
                        </section>

                        <section class="rounded-[1.75rem] border border-blue-200 bg-[#eaf2ff] p-6 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#0f3d91]">Public Kiosk</p>
                            <h2 class="mt-3 font-['Merriweather'] text-2xl font-bold text-slate-900">How employees attend</h2>
                            <div class="mt-5 rounded-xl border border-blue-200 bg-white p-5">
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Sample QR payload</p>
                                <p class="mt-2 font-mono text-2xl font-semibold text-slate-900">APARRI-00123</p>
                                <p class="mt-4 text-sm leading-6 text-slate-600">Employees present their printed or electronic QR code at the kiosk. The kiosk reads the employee ID and records attendance for the active event.</p>
                            </div>
                        </section>
                    </aside>
                </section>

                <section class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,0.95fr)_minmax(0,1.05fr)]">
                    <article class="rounded-[1.75rem] border border-blue-200 bg-white p-8 shadow-sm">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#0f3d91]">Attendance Flow</p>
                        <h2 class="mt-3 font-['Merriweather'] text-3xl font-bold text-slate-900">Operational sequence</h2>
                        <div class="mt-6 space-y-5">
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#0f3d91] text-sm font-bold text-white">1</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Create employee records</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">The administrator enters the employee name, office, and official employee ID, then generates the QR output for printing or mobile distribution.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#2563c9] text-sm font-bold text-white">2</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Activate the attendance event</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">The administrator selects the event that currently requires attendance, such as a flag ceremony, meeting, seminar, or office reporting period.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#5b8fdd] text-sm font-bold text-white">3</div>
                                <div>
                                    <p class="font-semibold text-slate-900">Record attendance at the kiosk</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-600">Employees present their QR code at the public kiosk. The kiosk records the employee ID under the active event without requiring an employee login account.</p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1">
                        <article class="rounded-[1.75rem] border border-blue-200 bg-white p-6 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#0f3d91]">System Policy</p>
                            <h3 class="mt-3 font-['Merriweather'] text-2xl font-bold text-slate-900">Employees do not need login accounts.</h3>
                            <p class="mt-4 text-sm leading-7 text-slate-600">The attendance workflow is based on administrator-issued QR codes, not employee self-service accounts. This keeps the kiosk fast, public, and easier to manage during on-site attendance collection.</p>
                        </article>

                        <article class="rounded-[1.75rem] border border-blue-200 bg-white p-6 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#0f3d91]">Municipal Coverage</p>
                            <h3 class="mt-3 font-['Merriweather'] text-2xl font-bold text-slate-900">One format across offices</h3>
                            <p class="mt-4 text-sm leading-7 text-slate-600">Different offices can maintain their own employee rosters while using the same QR format and kiosk procedure throughout LGU Aparri.</p>
                        </article>
                    </div>
                </section>
            </main>

            <footer class="border-t border-blue-200 bg-white/80">
                <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-6 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <p>LGU Aparri QR attendance portal.</p>
                    <p>Administrator-managed issuance and public kiosk attendance recording.</p>
                </div>
            </footer>
        </div>
    </body>
</html>