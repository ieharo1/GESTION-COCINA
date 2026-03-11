<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

    public $showModal = false;
    public $categoriaId;
    public $nombre;
    public $descripcion;
    public $search = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ];

    public function render()
    {
        $categorias = Categoria::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.categorias', compact('categorias'));
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
        $this->categoriaId = null;
        $this->nombre = '';
        $this->descripcion = '';
    }

    public function store()
    {
        $this->validate();
        Categoria::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        session()->flash('message', 'Categoría creada exitosamente.');
        $this->closeModal();
    }

    public function edit(Categoria $categoria)
    {
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $categoria = Categoria::find($this->categoriaId);
        $categoria->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        session()->flash('message', 'Categoría actualizada exitosamente.');
        $this->closeModal();
    }

    public function delete(Categoria $categoria)
    {
        $categoria->delete();
        session()->flash('message', 'Categoría eliminada exitosamente.');
    }
}
