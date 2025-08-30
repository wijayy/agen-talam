@php
    use App\Models\Setting;
@endphp

<div class="w-full bg-white border-t border-neutral-950 dark:bg-neutral-700">
    <flux:container>
        <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="">
                <div class="font-bold text-lg">Agen Talam</div>
                <div class="text-sm lg:text-base">Alamat : {{ Setting::where('key', 'alamat')->value('value') }} </div>
                <div class="text-sm lg:text-base">Nomor Telepon : <a target="_blank" class="underline" href="https://wa.me/{{ Setting::where('key', 'nomor_telepon')->value('value') }}">{{ Setting::where('key', 'nomor_telepon')->value('value') }}</a> </div>

            </div>
            <div class="">
                <div class=" font-semibold">Links</div>
                <div class=""><a href="{{ route('sk') }}">Syarat dan Ketentuan</a></div>
            </div>
            <div class="">
                <img class="w-1/2" src="{{ asset('assets/payment.png') }}" alt="Payment">
            </div>
        </div>
    </flux:container>
</div>
