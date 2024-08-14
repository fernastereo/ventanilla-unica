<?php

namespace App\Http\Controllers;

use App\Models\Peticion;
use Illuminate\Http\Request;
use App\Mail\PeticionEnviada;
use App\Mail\PeticionRecibida;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peticiones = Peticion::with('tipopeticion')->get();
        return response()->json($peticiones, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json(['message' => 'stored one!']);
        try {
            //validate the request
            $request->validate([
                'tipoPeticionId' => 'required|integer',
                'nombre'         => 'required|string',
                'email'          => 'required|email',
                'telefono'       => 'required|numeric',
                'mensaje'        => 'required|string'
            ]);

            //generate a consecutive number from radicado group by current year
            $current_year = date('Y');
            $last_radicado = Peticion::where('vigencia', $current_year)->max('radicado');
            //get the current date and time
            $current_date_time = date('Y-m-d H:i:s');
            //store the $request->all() in the database
            $peticion = Peticion::create([
                'tipopeticions_id'  => $request->input('tipoPeticionId'),
                'nombre'            => $request->input('nombre'),
                'email'             => $request->input('email'),
                'telefono'          => $request->input('telefono'),
                'mensaje'           => $request->input('mensaje'),
                'fecha_peticion'    => $current_date_time,
                'vigencia'          => $current_year,
                'radicado'          => $last_radicado + 1
            ]);
            $peticion->load('tipopeticion');

            if($peticion){
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new PeticionRecibida($peticion));
                Mail::to($peticion->email)->send(new PeticionEnviada($peticion));
                return response()->json([
                    'message' => 'Peticion creada con exito!',
                    'radicado' => 'VU-CU2VA-' . str_pad($peticion->radicado + 1, 4, '0', STR_PAD_LEFT) . "-$peticion->vigencia",
                    'error'  => false
                ], 200);
            } else {
                return response()->json([
                    'message' => 'error al enviar la Peticion!',
                    'radicado' => '',
                    'error'  => true
                ], 400);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->errors(),
                'radicado' => '',
                'error'  => true
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['message' => 'show one!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json(['message' => 'update!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
