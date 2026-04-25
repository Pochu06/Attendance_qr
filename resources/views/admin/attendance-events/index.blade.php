<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Events') }}
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
                    <h3 class="text-lg font-semibold text-gray-900">Create attendance event</h3>
                    <p class="mt-2 text-sm text-gray-600">Admins choose which event is currently active on the public kiosk.</p>
                </div>

                <form method="POST" action="{{ route('attendance.events.store') }}" class="grid gap-6 p-6 md:grid-cols-2">
                    @csrf

                    <div class="md:col-span-2">
                        <x-input-label for="title" :value="__('Event Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="starts_at" :value="__('Starts At')" />
                        <x-text-input id="starts_at" name="starts_at" type="datetime-local" class="mt-1 block w-full" :value="old('starts_at')" />
                        <x-input-error class="mt-2" :messages="$errors->get('starts_at')" />
                    </div>

                    <div>
                        <x-input-label for="ends_at" :value="__('Ends At')" />
                        <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="mt-1 block w-full" :value="old('ends_at')" />
                        <x-input-error class="mt-2" :messages="$errors->get('ends_at')" />
                    </div>

                    <div class="md:col-span-2">
                        <x-primary-button>
                            {{ __('Save Attendance Event') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>

            <section class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Configured events</h3>
                    @if ($activeEvent)
                        <p class="mt-2 text-sm text-gray-600">Current active event: <span class="font-semibold text-gray-900">{{ $activeEvent->title }}</span></p>
                    @endif
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($attendanceEvents as $attendanceEvent)
                        <div class="flex flex-col gap-4 p-6 lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $attendanceEvent->title }}</p>
                                <p class="mt-1 text-sm text-gray-600">{{ $attendanceEvent->description ?: 'No description provided.' }}</p>
                                <p class="mt-2 text-xs uppercase tracking-[0.2em] text-gray-500">
                                    @if ($attendanceEvent->starts_at)
                                        Starts {{ $attendanceEvent->starts_at->format('M d, Y h:i A') }}
                                    @endif
                                    @if ($attendanceEvent->ends_at)
                                        @if ($attendanceEvent->starts_at) · @endif Ends {{ $attendanceEvent->ends_at->format('M d, Y h:i A') }}
                                    @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                @if ($attendanceEvent->is_active)
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">Active</span>
                                @else
                                    <form method="POST" action="{{ route('attendance.events.activate', $attendanceEvent) }}">
                                        @csrf
                                        @method('PATCH')
                                        <x-primary-button>
                                            {{ __('Set Active') }}
                                        </x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-sm text-gray-600">No attendance events have been created yet.</div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>