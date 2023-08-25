<x-app-layout>
    <div class ="bg-gray-100 dark:bg-gray-900" style="display: flex; justify-content: center">
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"> 
            <h1 class="text-lg font-bold" style="text-align: center">{{ $problem->title }}</h1>
            <div class="flex justify-between w-full sm:max-w-xl mt-6 mb-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"> 
                <p> {{ $problem->description }} </p>
                <p> {{ $problem->created_at->diffForHumans() }} </p>
                @if($problem->attachment)
                    <a href= "{{ '/storage/' . $problem->attachment }}" target="_blank">Attachment</a>
                @endif
            </div>

            <div class="flex justify-between">
                <div class="flex">
                    <a href="{{ route('problem.edit', $problem->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>
                    <form class="ml-2" action="{{ route('problem.destroy', $problem->id) }}" method="post"> 
                        @method('delete')
                        @csrf
                        <x-primary-button>Delete</x-primary-button>
                    </form>
                </div>

                @if(auth()->user()->isAdmin)
                    <div class="flex">
                        <form action="{{ route('problem.update', $problem->id) }}" method="post" >
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="resolved" /> 
                            <x-primary-button>Resolve</x-primary-button>
                        </form>
                        <form action="{{ route('problem.update', $problem->id) }}" method="post" >
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected" /> 
                            <x-primary-button class="ml-2">Reject</x-primary-button>
                        </form>
                    </div>
                @else
                    <p>Status: {{ $problem->status }} </p>
                @endif
            </div>
        </div>
    </div>
    
</x-app-layout>