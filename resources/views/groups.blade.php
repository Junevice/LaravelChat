<x-app-layout>
    <div id="app">
        <router-view :user="{{ auth()->user() }}" :group="{{ $id }}"/>
    </div>
</x-app-layout>
