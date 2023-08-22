<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-dark dark:text-dark leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session()->has('success'))
            <div class="text-center py-3 bg-green-400 rounded-sm mx-auto">{{ session('success') }}</div>
        @endif

        <div class="relative overflow-x-auto">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg grid grid-cols-2 gap-2">
                @foreach ($tasks as $task)
                    <div class="bg-slate-400 text-center p-3 rounded-md">
                        <div class="bg-teal-500 rounded-md mb-3 text-left p-4 text-white h-32">
                            <p><span class="text-m">Task name: </span><span
                                    class="font-bold">{{ $task->name }}</span> </p>
                            <p>Task Description {{ $task->description }}</p>
                          
                        </div>
                        <div class="flex justify-around">
                        <form method="get" action="{{ route('tasklists.create') }}">
                           
                       
                            <input type="text" hidden name="id" value="{{ $task->id }}">
                            <x-primary-button>{{ __('Add to tasklist') }}</x-primary-button>
                        </form>

                        <form method="get" action="{{ route('recurringtasklists.create') }}">
                           
                       
                            <input type="text" hidden name="id" value="{{ $task->id }}">
                            <x-primary-button>{{ __('Make recurring') }}</x-primary-button>
                        </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>