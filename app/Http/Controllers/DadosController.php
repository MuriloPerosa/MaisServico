<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\User;
use Illuminate\Support\Facades\Auth;

class DadosController extends Controller
{
    public function contratosRealizados()
    {
        $user = Auth::user();
        $mes = Contrato::contratosRealizadosMes($user->id);
        $ano = Contrato::contratosRealizadosAno($user->id);

        $ContGeral = 0;
        $SumGeral = 0;

        foreach ($ano as $a) {
            $ContGeral = $ContGeral + $a->cont;
            $SumGeral = $SumGeral + $a->valor;
        }

        foreach ($mes as $m) {
            switch ($m->mes) {
                case 1:
                    $m->mes = "Janeiro";
                    break;
                case 2:
                    $m->mes = "Fevereiro";
                    break;
                case 3:
                    $m->mes = "Março";
                    break;
                case 4:
                    $m->mes = "Abril";
                    break;
                case 5:
                    $m->mes = "Maio";
                    break;
                case 6:
                    $m->mes = "Junho";
                    break;
                case 7:
                    $m->mes = "Julho";
                    break;
                case 8:
                    $m->mes = "Agosto";
                    break;
                case 9:
                    $m->mes = "Setembro";
                    break;
                case 10:
                    $m->mes = "Outubro";
                    break;
                case 11:
                    $m->mes = "Novembro";
                    break;
                default:
                    $m->mes = "Dezembro";
            }
        }

        return view('dados.contratosRealizados', ['ano' => $ano, 'mes' => $mes, 'ContGeral' => $ContGeral, 'SumGeral' => $SumGeral]);
    }
}