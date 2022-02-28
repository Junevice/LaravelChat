<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div id="app">
        <router-view :user="{{ auth()->user() }}"/>
    </div>
</x-app-layout>
