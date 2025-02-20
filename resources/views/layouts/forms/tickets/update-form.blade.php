@props(['ticket'])

<x-modal name="update-ticket-{{ $ticket->id }}" focusable>
    <form method="POST" action="{{ route('client.tickets.update', $ticket->id) }}" class="p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Mettre à jour le ticket') }} - {{ $ticket->title }}
        </h2>

        <div class="mt-6">
            <x-input-label for="title" :value="__('Titre')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ $ticket->title }}" required />
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
            >{{ $ticket->description }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Mettre à jour') }}
            </x-primary-button>
        </div>
    </form>
</x-modal> 