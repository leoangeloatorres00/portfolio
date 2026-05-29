<div>
    <x-slot name="navbar">
        @livewire('navbar')
    </x-slot>

    <x-slot name="content">
        @livewire('hero')
        @livewire('aboutme')
        @livewire('skills')
        @livewire('projects')
    </x-slot>

    <x-slot name="others">
        @livewire('carousel')
        @livewire('contactus')
    </x-slot>
</div>