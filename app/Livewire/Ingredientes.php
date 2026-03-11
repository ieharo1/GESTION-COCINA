<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ingrediente;

class Ingredientes extends Component
{
    use WithPagination;

    public $showModal = false;
    public $ingredienteId;
    public $nombre;
    public $unidad;
    public $search = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'unidad' => 'required|string|max:50',
    ];

    public function render()
    {
        $ingredientes = Ingrediente::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.ingredientes', compact('ingredientes'));
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetFields()
    {
        $this->ingredienteId = null;
        $this->nombre = '';
        $this->unidad = '';
    }

    public function store()
    {
        $this->validate();
        Ingrediente::create([
            'nombre' => $this->nombre,
            'unidad' => $this->unidad,
        ]);
        session()->flash('message', 'Ingrediente creado exitosamente.');
        $this->closeModal();
    }

    public function edit(Ingrediente $ingrediente)
    {
        $this->ingredienteId = $ingrediente->id;
        $this->nombre = $ingrediente->nombre;
        $this->unidad = $ingrediente->unidad;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $ingrediente = Ingrediente::find($this->ingredienteId);
        $ingrediente->update([
            'nombre' => $this->nombre,
            'unidad' => $this->unidad,
        ]);
        session()->flash('message', 'Ingrediente actualizado exitosamente.');
        $this->closeModal();
    }

    public function delete(Ingrediente $ingrediente)
    {
        $ingrediente->delete();
        session()->flash('message', 'Ingrediente eliminado exitosamente.');
    }
}
