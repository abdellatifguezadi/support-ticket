<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes Tickets') }}
            </h2>
            <x-primary-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-ticket')"
            >
                {{ __('Nouveau Ticket') }}
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tickets as $ticket)
                        <x-ticket-card :ticket="$ticket" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-ticket" focusable>
        <form method="POST" action="{{ route('client.tickets.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Créer un nouveau ticket') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="title" :value="__('Titre')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div class="mt-6">
                <x-input-label for="description" :value="__('Description')" />
                <textarea
                    id="description"
                    name="description"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    rows="4"
                    required
                ></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Créer') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout> 