<?php

namespace Database\Seeders;

use App\Models\Subtipopeticion;
use App\Models\Tipopeticion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipopeticionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipopeticion::truncate();
        Subtipopeticion::truncate();
        
        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Aclaratoria de Licencia',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Aclaratoria de Licencia', 
                'activo' => true, 
                'visible' => false,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);


        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Anexos de Radicados en Curso',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Comprobante de Pago Expensas', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Comprobante de Pago Impuestos', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Copia de Planos', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Documentos para Completar Radicación', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Correcciones Acta de Observaciones', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia'
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Foto de Valla', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Prórroga Acta de Observaciones', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Otros Documentos/Anexos', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia'
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);


        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Citas para Radicación o Asesorías',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Solicitud de Radicación', 
                'activo' => true, 
                'visible' => false,
                'campos' => null, 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Asesor Arquitectura', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Asesor Jurídico', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Asesor Ingeniería', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);

        
        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Derecho de Peticion',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Solicitud de Derecho de Peticion', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Respuesta Derecho de Peticion', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Hacerse parte dentro de un Trámite', 
                'activo' => true, 
                'visible' => true,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);


        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Desistimiento de Licencia',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Desistimiento de Licencia', 
                'activo' => true, 
                'visible' => false,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);


        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Informacion',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Información', 
                'activo' => true, 
                'visible' => false,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);

        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Otras Actuaciones',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Concepto de Norma Urbanística', 
                'activo' => true, 
                'visible' => true,
                'campos' => null, 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Concepto de Uso', 
                'activo' => true, 
                'visible' => true,
                'campos' => null, 
                'tipopeticion_id' => $id
            ]
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Reparaciones Locativas', 
                'activo' => true, 
                'visible' => true,
                'campos' => null, 
                'tipopeticion_id' => $id
            ]
        ]);


        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Prórroga de Licencia',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Prórroga de Licencia', 
                'activo' => true, 
                'visible' => false,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => true
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => true
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => true
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);

        $id = DB::table('tipopeticions')->insertGetId([
            'descripcion'   => 'Quejas - Reclamos',
            'activo'        => true
        ]);
        DB::table('subtipopeticions')->insert([
            [
                'descripcion' => 'Quejas - Reclamos', 
                'activo' => true, 
                'visible' => false,
                'campos' => json_encode([
                    'tipoRadicado' => [
                        'label' => 'Tipo de Radicado',
                        'type' => 'select',
                        'options' => [
                            'Licencia',
                            'Otras Actuaciones',
                            'Prórroga de Licencia',
                        ],
                        'required' => false
                    ],
                    'vigencia' => [
                        'label' => 'Vigencia',
                        'type' => 'number',
                        'placeholder' => 'Vigencia',
                        'required' => false
                    ],  
                    'numero' => [
                        'label' => 'Número',
                        'type' => 'number',
                        'placeholder' => 'Número',
                        'required' => false
                    ],
                ]), 
                'tipopeticion_id' => $id
            ]
        ]);


    }
}
