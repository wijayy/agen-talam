<?php

namespace App\Livewire;

use Livewire\Component;

class PesanTiket extends Component
{
    public $show = false;
    public $nama, $email, $jumlah;

    protected $listeners = ['openModal' => 'open'];

    public function open()
    {
        $this->show = true;
    }

    protected $rules = [
        'nama' => 'required|string|max:100',
        'email' => 'required|email',
        'jumlah' => 'required|integer|min:1',
    ];

    public function submit()
    {
        $this->validate();

        // Simpan data atau kirim email atau apapun
        // Contoh:
        // Reservation::create([...]);

        session()->flash('success', 'Pemesanan berhasil dikirim!');

        $this->reset(['show', 'nama', 'email', 'jumlah']);
    }

    public function render()
    {
        return view('livewire.pesan-tiket');
    }
}
