<x-app-layout>
    <div class ="bg-gray-100 dark:bg-gray-900" style="display: flex; justify-content: center">
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"> 
        <h1 class="text-lg font-bold" style="text-align: center">Edit Problem</h1>
            <form method="POST" action=" {{ route('problem.update', $problem->id) }} " enctype="multipart/form-data"> 
                @csrf
                @method('patch')
                <div class="mt-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" autofocus value="{{ $problem->title }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea name="description" id="description" value="{{ $problem->description }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="attachment" :value="__('Attachment (if any)')" />
                    <x-file-input name="attachment" id="attachment" />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>
                <div class="flex justify-end mt-4"> 
                    <x-primary-button class="ml-3"> 
                        Update
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
    
</x-app-layout>