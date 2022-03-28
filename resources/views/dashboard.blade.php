<x-app-layout>
    <div id="app">
        <router-view :user="{{ auth()->user() }}"/>
    </div>
</x-app-layout>
