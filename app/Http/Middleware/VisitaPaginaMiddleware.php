<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VisitaPaginaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Middleware ejecutado');

        
$user = Auth::user();
        $paginaNombre = $request->route()->getName();

        Log::info('Datos iniciales', [
            'usuario' => $user ? $user->codUsuario : 'No autenticado',
            'paginaNombre' => $paginaNombre,
        ]);

        if ($user && $paginaNombre) {
            try {
                DB::transaction(function () use ($user, $paginaNombre, $request) {
                    Log::info('Iniciando transacción');

                    // Consultar si la página ya existe en la base de datos
                    $pagina = DB::table('Pagina')->where('nombrePagina', $paginaNombre)->first();

                    if (!$pagina) {
                        Log::info('Insertando nueva página', ['nombrePagina' => $paginaNombre]);
                        $paginaId = DB::table('Pagina')->insertGetId([
                            'nombrePagina' => $paginaNombre,
                            'conteoVisitas' => 0,
                        ]);
                    } else {
                        $paginaId = $pagina->id;
                    }

                    Log::info('Página obtenida', ['paginaId' => $paginaId]);

                    // Verificar si el usuario ya ha visitado esta página
                    $visita = DB::table('visitaPagina')
                        ->where('codUsuario', $user->codUsuario)
                        ->where('codPagina', $paginaId)
                        ->first();

                    if ($visita) {
                        Log::info('Actualizando visita existente');
                        DB::table('visitaPagina')
                            ->where('codUsuario', $user->codUsuario)
                            ->where('codPagina', $paginaId)
                            ->increment('cantidad', 1);
                    } else {
                        Log::info('Insertando nueva visita');
                        DB::table('visitaPagina')->insert([
                            'codUsuario' => $user->codUsuario,
                            'codPagina' => $paginaId,
                            'cantidad' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    // Actualizar el conteo total de visitas de la página
                    $totalVisitas = DB::table('visitaPagina')
                        ->where('codPagina', $paginaId)
                        ->sum('cantidad');

                    DB::table('Pagina')
                        ->where('id', $paginaId)
                        ->update(['conteoVisitas' => $totalVisitas]);

                    // Compartir el conteo de visitas con la vista
                    $request->attributes->set('visitas_pagina', $totalVisitas);

                    Log::info('Transacción completada', ['totalVisitas' => $totalVisitas]);
                });
            } catch (\Exception $e) {
                Log::error('Error en middleware de visitas', ['error' => $e->getMessage()]);
            }
        }

        return $next($request);
    }
}
