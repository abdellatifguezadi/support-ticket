@props(['ticket'])

<x-modal name="delete-ticket-{{ $ticket->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Confirmer la suppression') }}
        </h2>
        <p class="mt-4 text-gray-600 dark:text-gray-300">
            Êtes-vous sûr de vouloir supprimer ce ticket ?
        </p>
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Annuler') }}
            </x-secondary-button>
            <form method="POST" action="{{ route('client.tickets.destroy', $ticket->id) }}" class="ml-2">
                @csrf
                <x-danger-button type="submit">
                    {{ __('Supprimer') }}
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal> 