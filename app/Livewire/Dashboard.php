<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Receta;
use App\Models\Ingrediente;
use App\Models\Menu;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $totalRecetas;
    public $totalIngredientes;
    public $menusSemana;

    public function mount()
    {
        $this->totalRecetas = Receta::count();
        $this->totalIngredientes = Ingrediente::count();
        $this->menusSemana = Menu::where('fecha', '>=', Carbon::now()->startOfWeek())
            ->where('fecha', '<=', Carbon::now()->endOfWeek())
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
