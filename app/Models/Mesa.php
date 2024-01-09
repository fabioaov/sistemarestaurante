<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mesa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mesa',
        'vagas',
    ];

    /**
     * Retorna todas as mesas
     * 
     * @return array([object, ...])
     */
    public static function getMesas()
    {
        /*return DB::table('mesas')
            ->leftJoin('comandas', 'mesas.id', '=', 'comandas.id_mesa')
            ->select('mesas.*', 'comandas.condicao as condicao', 'comandas.id')
            ->groupBy('mesas.id')
            ->get();*/

        return DB::table('mesas')
            ->leftJoin('comandas', function ($join) {
                $join->on('comandas.id_mesa', '=', 'mesas.id')
                    ->whereRaw('comandas.id IN (select MAX(comandas.id) from comandas join mesas on mesas.id = comandas.id_mesa group by mesas.id)');
            })
            ->select('mesas.*', 'comandas.condicao as condicao')
            ->get();
    }
}
