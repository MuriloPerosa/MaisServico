<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;
use App\Cidade;
use App\Oferta;
use App\Necessidade;
use App\Categoria;
use App\Contrato;
use App\User;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function localizacao($id)
    {

        if ($this->allowedUser()) {
            $cidade = Cidade::find($id);

            if ($cidade != null) {

                $ofertasTotal = $cidade->ofertas->count();
                $ofertasAtivas = $cidade->ofertas->where('ativo', true)->count();
                $necessidadesTotal = $cidade->necessidades->count();
                $necessidadesAtivas = $cidade->necessidades->where('ativo', true)->count();
                $usersCount = $cidade->pessoas->count();
                $topOfertas = Oferta::where('cidade_id', $id)->where('ativo', true)->orderBy('media_notas', 'DESC')->paginate(5);
                $topNecessidades = Necessidade::where('cidade_id', $id)->where('ativo', true)->orderBy('created_at', 'DESC')->paginate(5);

                $data = array(
                    'cidade' => $cidade, 'ofertasTotal' => $ofertasTotal, 'ofertasAtivas' => $ofertasAtivas,
                    'necessidadesTotal' => $necessidadesTotal, 'necessidadesAtivas' => $necessidadesAtivas,
                    'usersCount' => $usersCount, 'topOfertas' => $topOfertas, 'topNecessidades' => $topNecessidades
                );


                $pdf = PDF::loadView('pdf.localizacao', $data);
                return $pdf->download('Relatório_Localização.pdf');
            } else {
                return redirect('/home');
            }
        } else {
            return redirect('/home');
        }
    }



    public function categoria($id)
    {
        if ($this->allowedUser()) {
            $categoria = Categoria::find($id);

            if ($categoria != null) {

                $ofertasTotal = $categoria->ofertas->count();
                $ofertasAtivas = $categoria->ofertas->where('ativo', true)->count();
                $necessidadesTotal = $categoria->necessidades->count();
                $necessidadesAtivas = $categoria->necessidades->where('ativo', true)->count();
                $topOfertas = Oferta::where('categoria_id', $id)->where('ativo', true)->orderBy('media_notas', 'DESC')->paginate(5);
                $topNecessidades = Necessidade::where('categoria_id', $id)->where('ativo', true)->orderBy('created_at', 'DESC')->paginate(5);

                $data = array(
                    'categoria' => $categoria, 'ofertasTotal' => $ofertasTotal, 'ofertasAtivas' => $ofertasAtivas,
                    'necessidadesTotal' => $necessidadesTotal, 'necessidadesAtivas' => $necessidadesAtivas,
                    'topOfertas' => $topOfertas, 'topNecessidades' => $topNecessidades
                );


                $pdf = PDF::loadView('pdf.categoria', $data);
                return $pdf->download('Relatório_Categoria.pdf');
            } else {
                return redirect('/home');
            }
        } else {
            return redirect('/home');
        }
    }

    public function servicos($ano)
    {
        if ($this->allowedUser()) {

            $servicos = Contrato::where('data_realizado', '!=', null)->whereYear('created_at', $ano)->get();
            $data = array('ano' => $ano, 'servicos' => $servicos);
            $pdf = PDF::loadView('pdf.servicosAno', $data);
            return $pdf->download('Relatório_Serviços_Ano.pdf');
        } else {
            return redirect('/home');
        }

    }

    //Verifica se o usuário logado é administrador
    public function allowedUser()
    {
        if (Auth::user()->administrador) {
            return true;
        }

        return false;
    }
}
