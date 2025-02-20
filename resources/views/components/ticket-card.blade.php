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
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Client: {{ $ticket->user->name }}</span>
                </div>
            @else
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Agent: {{ $ticket->agent ? $ticket->agent->name : 'Non assigné' }}</span>
                </div>
            @endif
            
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Créé le: {{ $ticket->created_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

 
    <div class="px-6 py-3 bg-gray-50 dark:bg-gray-600">
        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
            {{ $showUserInfo ? 'Gérer le ticket' : 'Voir les détails' }}
        </button>
    </div>
</div> 