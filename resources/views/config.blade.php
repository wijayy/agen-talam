@php
use App\Models\Setting;
@endphp

<x-layouts.admin>
    <div class="p-4 space-y-4">
        <div class="text-lg font-semibold">Bussiness Configuration</div>

        <flux:session></flux:session>

        <form action="{{ route('config.store') }}" class="space-y-4" method="post">
            @csrf
            <flux:input wire:model='harga' :label="__('Harga Tiket')" type="number"
                value="{{ old('harga', Setting::where('key', 'harga')->value('value')) }}" class=""></flux:input>
            <flux:input wire:model='alamat' :label="__('Alamat Markas Keberangkatan')"
                value="{{ old('markas', Setting::where('key', 'alamat')->value('value')) }}" class=""></flux:input>
            <flux:input wire:model='nomor_telepon' :label="__('Nomor Telepon')"
                value="{{ old('phone', Setting::where('key', 'nomor_telepon')->value('value')) }}" class="">
            </flux:input>
            <flux:action-a class="bg-neutral-200 dark:bg-neutral-700 hover:bg-mine-400" as>Submit</flux:action-a>
        </form>

    </div>
</x-layouts.admin>
