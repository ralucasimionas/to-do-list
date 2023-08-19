<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight text-center">
            {{ __('Current Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session()->has('success'))
      <div class="text-center py-3 bg-green-400 rounded-sm">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto flex justify-center p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg">
            <div class="p-4 sm:p-8 bg-white dark:bg-white-800 shadow sm:rounded-lg ">
                <div class="">
                    <table class="w-full text-sm  text-gray-500 dark:text-gray-400">
                        <thead class="text-lg text-black uppercase bg-green-500 dark:bg-white-700 dark:text-black">
                            <tr>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                    Task ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Task Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Task Description
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            
                            
                          

                                <tr class="bg-white border-b  text-center dark:bg-white-800 dark:border-gray-700">
                                    <th scope="col"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        <a href={{ route('tasks.show', $task->id) }}>{{ $task->id }}</a>
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ $task->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                                        {{ $task->description }} 
                                    </td>
                                   
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>