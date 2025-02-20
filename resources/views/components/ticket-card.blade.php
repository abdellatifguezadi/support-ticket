@props(['ticket', 'showUserInfo' => false])

<div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
   
    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-600 border-b dark:border-gray-600">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ $ticket->title }}
            </h3>
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800' : 
                   ($ticket->status === 'closed' ? 'bg-red-100 text-red-800' : 
                   'bg-yellow-100 text-yellow-800') }}">
                {{ $ticket->status }}
            </span>
        </div>
    </div>

   
    <div class="px-6 py-4">
        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
            {{ Str::limit($ticket->description, 150) }}
        </p>
        
        
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
            @if($showUserInfo)
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span>Client: {{ $ticket->user->name }}</span>
                </div>
            @else
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span>Agent: {{ $ticket->agent ? $ticket->agent->name : 'Non assigné' }}</span>
                </div>
            @endif
            
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                <span>Créé le: {{ $ticket->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

 
    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-600">
        <button 
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'ticket-details-{{ $ticket->id }}')"
        >
            Voir les détails
        </button>
    </div>

    <!-- Modal pour les détails du ticket -->
    <x-modal name="ticket-details-{{ $ticket->id }}" focusable>
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                {{ $ticket->title }}
            </h2>
            <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $ticket->description }}</p>
            <div class="mt-4">
                <p class="font-semibold">Status:</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $ticket->status }}</p>
                <p class="font-semibold mt-2">Créé le:</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                <p class="font-semibold mt-2">Client:</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $ticket->user->name }}</p>
                <p class="font-semibold mt-2">Agent:</p>
                <p class="text-gray-600 dark:text-gray-400">{{ $ticket->agent ? $ticket->agent->name : 'Non assigné' }}</p>
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Fermer') }}
                </x-secondary-button>
                @if($ticket->status === 'open')
                    <x-primary-button class="ml-2" x-on:click.prevent="$dispatch('open-modal', 'update-ticket-{{ $ticket->id }}')">
                        {{ __('Mettre à jour') }}
                    </x-primary-button>
                    <form method="POST" action="{{ route('client.tickets.close', $ticket->id) }}" class="ml-2">
                        @csrf
                        <x-primary-button class="bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700">
                            {{ __('Marquer comme fermé') }}
                        </x-primary-button>
                    </form>
                    <x-danger-button class="ml-2" x-on:click.prevent="$dispatch('open-modal', 'delete-ticket-{{ $ticket->id }}')">
                        {{ __('Supprimer') }}
                    </x-danger-button>
                @endif
            </div>
        </div>
    </x-modal>



    @if($ticket->status === 'open')
        @include('layouts.forms.tickets.update-form', ['ticket' => $ticket])
        @include('layouts.forms.tickets.delete-form', ['ticket' => $ticket])
    @endif
</div> 