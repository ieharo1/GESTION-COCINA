<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Menu;
use App\Models\Receta;
use Carbon\Carbon;

class Menus extends Component
{
    use WithPagination;

    public $showModal = false;
    public $menuId;
    public $nombre;
    public $fecha;
    public $search = '';
    public $selectedRecipes = [];
    public $availableRecipes;
    public $editMode = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'fecha' => 'required|date',
    ];

    public function mount()
    {
        $this->availableRecipes = Receta::all();
    }

    public function render()
    {
        $menus = Menu::when($this->search, function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.menus', compact('menus'));
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
        $this->menuId = null;
        $this->nombre = '';
        $this->fecha = Carbon::now()->toDateString();
        $this->selectedRecipes = [];
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate();

        $menu = Menu::create([
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
        ]);

        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $dayIndex = Carbon::parse($this->fecha)->dayOfWeek - 1;
        
        foreach ($this->selectedRecipes as $index => $recipe) {
            if (!empty($recipe['receta_id'])) {
                $menu->recetas()->attach($recipe['receta_id'], [
                    'dia_semana' => $days[$index % 7]
                ]);
            }
        }

        session()->flash('message', 'Menú creado exitosamente.');
        $this->closeModal();
    }

    public function edit(Menu $menu)
    {
        $this->menuId = $menu->id;
        $this->nombre = $menu->nombre;
        $this->fecha = $menu->fecha->toDateString();
        $this->editMode = true;

        $this->selectedRecipes = $menu->recetas->map(function ($receta, $index) {
            return [
                'receta_id' => $receta->id,
                'dia_semana' => $receta->pivot->dia_semana
            ];
        })->toArray();

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $menu = Menu::find($this->menuId);
        $menu->update([
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
        ]);

        $menu->recetas()->detach();
        foreach ($this->selectedRecipes as $recipe) {
            if (!empty($recipe['receta_id'])) {
                $menu->recetas()->attach($recipe['receta_id'], [
                    'dia_semana' => $recipe['dia_semana'] ?? 'Lunes'
                ]);
            }
        }

        session()->flash('message', 'Menú actualizado exitosamente.');
        $this->closeModal();
    }

    public function delete(Menu $menu)
    {
        $menu->delete();
        session()->flash('message', 'Menú eliminado exitosamente.');
    }

    public function addRecipe()
    {
        $this->selectedRecipes[] = [
            'receta_id' => '',
            'dia_semana' => ''
        ];
    }

    public function removeRecipe($index)
    {
        unset($this->selectedRecipes[$index]);
        $this->selectedRecipes = array_values($this->selectedRecipes);
    }

    public function getWeeklyMenus()
    {
        return Menu::with('recetas')
            ->where('fecha', '>=', Carbon::now()->startOfWeek())
            ->where('fecha', '<=', Carbon::now()->endOfWeek())
            ->orderBy('fecha')
            ->get();
    }
}
