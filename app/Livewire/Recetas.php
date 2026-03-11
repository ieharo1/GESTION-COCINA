<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Receta;
use App\Models\Categoria;
use App\Models\Ingrediente;

class Recetas extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $recetaId;
    public $name;
    public $description;
    public $tiempo_preparacion;
    public $porciones;
    public $foto;
    public $instrucciones;
    public $categoria_id;
    public $selectedIngredients = [];
    public $categorias;

    protected $rules = [
        'name' => 'required|string|max:255',
        'tiempo_preparacion' => 'required|integer|min:1',
        'porciones' => 'required|integer|min:1',
        'categoria_id' => 'nullable|exists:categorias,id',
    ];

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function render()
    {
        $recetas = Receta::with('categoria')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.recetas', compact('recetas'));
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
        $this->recetaId = null;
        $this->name = '';
        $this->description = '';
        $this->tiempo_preparacion = '';
        $this->porciones = '';
        $this->foto = '';
        $this->instrucciones = '';
        $this->categoria_id = '';
        $this->selectedIngredients = [];
    }

    public function store()
    {
        $this->validate();

        $receta = Receta::create([
            'name' => $this->name,
            'description' => $this->description,
            'tiempo_preparacion' => $this->tiempo_preparacion,
            'porciones' => $this->porciones,
            'foto' => $this->foto,
            'instrucciones' => $this->instrucciones,
            'categoria_id' => $this->categoria_id,
        ]);

        foreach ($this->selectedIngredients as $ingredient) {
            if (!empty($ingredient['ingrediente_id']) && !empty($ingredient['cantidad'])) {
                $receta->ingredientes()->attach($ingredient['ingrediente_id'], [
                    'cantidad' => $ingredient['cantidad']
                ]);
            }
        }

        session()->flash('message', 'Receta creada exitosamente.');
        $this->closeModal();
    }

    public function edit(Receta $receta)
    {
        $this->recetaId = $receta->id;
        $this->name = $receta->name;
        $this->description = $receta->description;
        $this->tiempo_preparacion = $receta->tiempo_preparacion;
        $this->porciones = $receta->porciones;
        $this->foto = $receta->foto;
        $this->instrucciones = $receta->instrucciones;
        $this->categoria_id = $receta->categoria_id;

        $this->selectedIngredients = $receta->ingredientes->map(function ($ing) {
            return [
                'ingrediente_id' => $ing->id,
                'cantidad' => $ing->pivot->cantidad
            ];
        })->toArray();

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $receta = Receta::find($this->recetaId);
        $receta->update([
            'name' => $this->name,
            'description' => $this->description,
            'tiempo_preparacion' => $this->tiempo_preparacion,
            'porciones' => $this->porciones,
            'foto' => $this->foto,
            'instrucciones' => $this->instrucciones,
            'categoria_id' => $this->categoria_id,
        ]);

        $receta->ingredientes()->detach();
        foreach ($this->selectedIngredients as $ingredient) {
            if (!empty($ingredient['ingrediente_id']) && !empty($ingredient['cantidad'])) {
                $receta->ingredientes()->attach($ingredient['ingrediente_id'], [
                    'cantidad' => $ingredient['cantidad']
                ]);
            }
        }

        session()->flash('message', 'Receta actualizada exitosamente.');
        $this->closeModal();
    }

    public function delete(Receta $receta)
    {
        $receta->delete();
        session()->flash('message', 'Receta eliminada exitosamente.');
    }

    public function addIngredient()
    {
        $this->selectedIngredients[] = [
            'ingrediente_id' => '',
            'cantidad' => ''
        ];
    }

    public function removeIngredient($index)
    {
        unset($this->selectedIngredients[$index]);
        $this->selectedIngredients = array_values($this->selectedIngredients);
    }
}
