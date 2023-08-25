<x-app-layout>
    <div class ="bg-gray-100 dark:bg-gray-900" style="display: flex; justify-content: center">
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"> 
            <h1 class="text-lg font-bold" style="text-align: center">Support problems</h1>
            <div>
                <a href="{{ route('problem.create') }}" class=" rounded-lg p-2" style="background:LightBlue">Create New</a>
            </div>
        
            <div class="w-full sm:max-w-xl mt-6 px-6 py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                @forelse ($problems as $problem)
                    <div class="flex justify-between py-4"> 
                        <a href="{{ route('problem.show' , $problem->id) }}">{{ $problem->title }} </a>
                        <p>{{ $problem->created_at->diffForHumans() }} </p>
                    </div>
                @empty
                <p>You don't have any support problem yet. </p>

                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>