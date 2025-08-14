<div>
    @if($show)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-xl font-bold mb-4">Form Pemesanan Tiket</h2>

            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label class="block mb-1">Nama</label>
                    <input type="text" wire:model.defer="nama" class="w-full border rounded px-3 py-2" />
                    @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email" wire:model.defer="email" class="w-full border rounded px-3 py-2" />
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Jumlah Orang</label>
                    <input type="number" wire:model.defer="jumlah" min="1" class="w-full border rounded px-3 py-2" />
                    @error('jumlah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="$set('show', false)"
                        class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Kirim</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
