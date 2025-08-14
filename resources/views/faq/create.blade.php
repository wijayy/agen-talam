@php

$title = ($faq ?? false) ? "Edit FaQ" : "Add new FaQ"

@endphp

<x-layouts.admin title="{{ $title }}" class="admin">
    <div class="p-4">
        <div class="text-xl font-semibold">{{ $title }} </div>
        <form action="{{ ($faq??false ) ? route('faq.update', ['faq'=>$faq->id]) : route('faq.store') }}" method="post">
            @csrf
            @if ($faq ?? false)
            @method('put')
            @endif

            <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-2">
                <flux:input value="{{ $faq->question ?? '' }}" wire:model="question" :label="__('Question')" type="text"
                    required autofocus autocomplete="question" />
                <flux:input value="{{ $faq->order ?? '' }}" wire:model="order" :label="__('order')" type="number"
                    required autocomplete="order" />
            </div>
            <flux:input value="{{ $faq->answer ?? '' }}" wire:model="answer" :label="__('answer')" type="text" required
                autocomplete="answer" />

                <div class="flex justify-center w-full mt-4">
                    <flux:action-a as class="bg-mine-400" >Submit</flux:action-a>
                </div>
        </form>
    </div>
</x-layouts.admin>
