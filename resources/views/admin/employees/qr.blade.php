<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Printable Employee QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <section class="overflow-hidden bg-white shadow-sm sm:rounded-2xl">
                <div class="grid gap-8 p-8 md:grid-cols-[minmax(0,0.95fr)_minmax(280px,1.05fr)] md:p-10">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-700">Employee QR Card</p>
                        <h3 class="mt-3 text-3xl font-semibold text-gray-900">{{ $employee->name }}</h3>
                        <dl class="mt-6 space-y-4 text-sm text-gray-700">
                            <div>
                                <dt class="font-semibold text-gray-500">Employee ID</dt>
                                <dd class="mt-1 font-mono text-base text-gray-900">{{ $employee->employee_id }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-500">Office</dt>
                                <dd class="mt-1 text-base text-gray-900">{{ $employee->office ?: 'Not specified' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-500">QR payload</dt>
                                <dd class="mt-1 text-base text-gray-900">Employee ID only</dd>
                            </div>
                        </dl>

                        <p class="mt-8 text-sm leading-6 text-gray-600">This page is suitable for browser printing or electronic sharing as an employee e-QR reference.</p>
                    </div>

                    <div class="rounded-[2rem] border border-gray-200 bg-gray-50 p-6 shadow-inner">
                        <div class="rounded-[1.5rem] bg-white p-5 shadow-sm ring-1 ring-gray-200">
                            <div class="flex items-center justify-center text-gray-900">
                                {{ $qrSvg }}
                            </div>
                            <div class="mt-5 border-t border-gray-100 pt-5 text-center">
                                <p class="text-sm font-semibold text-gray-500">{{ $employee->name }}</p>
                                <p class="mt-1 font-mono text-lg font-semibold text-gray-900">{{ $employee->employee_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>