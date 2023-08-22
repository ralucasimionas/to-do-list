<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black text-center dark:text-blackleading-tight">
            {{ __($recurringTask->task->name) }}
        </h2>
    </x-slot>
    @if (session()->has('success'))
        <div class="text-center py-3 bg-green-400 rounded-sm">{{ session('success') }}</div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('recurringtasklists.update', $recurringTask->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        
                    
                        <div class='mt-4'>  
                            <x-input-label for="name" :value="__('Task name')" />
                             <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-100" :value="old('name', $recurringTask->task->name)"  required  readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class='mt-4'>  
                            <x-input-label for="description" :value="__('Description')" />
                             <x-text-input id="description" name="description" type="text" class="mt-1 block w-full bg-gray-100" :value="old('description', $recurringTask->task->description)"  required readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
    
                    <div class='mt-4'>  
                        <x-input-label for="recurrence" :value="__('Recurrence')" />
                         <x-text-input id="recurrence" name="recurrence" type="number" class="mt-1 block w-full" :value="old('recurrence', $recurringTask->recurrence)"  required />
                        <x-input-error class="mt-2" :messages="$errors->get('recurrence')" />
                    </div>
    
                    <div class='mt-4'>  
                        <x-input-label for="start_date" :value="__('Start date')" />
                         <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full bg-gray-100" :value="old('recurrence', $recurringTask->start_date)" required readonly />
                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                    </div>
    
                    <div class='mt-4'>  
                        <x-input-label for="finish_date" :value="__('Finish date')" />
                         <x-text-input id="finish_date" name="finish_date" type="date" class="mt-1 block w-full" :value="old('recurrence', $recurringTask->finish_date)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('finish_date')" />
                    </div>


                        <x-primary-button>{{ __('Edit recurrence') }}</x-primary-button>

                    </form> 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>