<?php

namespace Modules\PkgWidget\App\Services;

use Illuminate\Support\Facades\Auth;

use Modules\PkgWidget\Models\Apprenant;



class WidgetService
{
    public function getNombreApprenant()
    {
        $nombre = Apprenant::count();
        return [
            'titre' => 'Nombre d\'apprenants',
            'valeur' => $nombre
        ];
    }

        // Retourne un titre, une liste de 5 apprenants et le nombre total
        public function getApprenantsActifs()
        {
            $apprenantsActifs = Apprenant::where('actif', true)->take(5)->get();
            $nombreActifs = Apprenant::where('actif', true)->count();
            return [
                'titre' => 'Apprenants actifs',
                'liste' => $apprenantsActifs,
                'total' => $nombreActifs
            ];
        }
}
