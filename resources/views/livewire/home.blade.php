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
        @livewire('contactus')
        @livewire('carousel')
    </x-slot>
</div>