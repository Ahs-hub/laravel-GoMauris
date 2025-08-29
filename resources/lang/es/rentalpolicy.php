<?php
// resources/lang/es/rental.php

return [

    'title' => 'Condiciones de Alquiler',

    'insurance' => [
        'title' => '1. Cobertura de Seguro Integral',
        'intro' => 'En GoMauris, su tranquilidad es nuestra prioridad. Nuestra Cobertura de Seguro Integral —incluyendo una Exención de Daños por Colisión (CDW)— proporciona una protección sólida más allá de los simples accidentes. Al reservar directamente a través de nuestro sitio web, recibe cobertura completa sin necesidad de pólizas adicionales.',
        'includes_title' => 'Nuestros alquileres incluyen:',
        'includes' => [
            'accident' => 'Cobertura de accidentes: Protección incluso si usted tiene la culpa, siempre que complete una Declaración Amistosa de Accidente en el lugar',
            'theft' => 'Protección contra robo: Cobertura por incidentes de robo (excepto pertenencias personales)',
            'fire' => 'Incendio, desastres naturales y vandalismo: Protección contra incendios, inundaciones repentinas y vandalismo',
            'damage' => 'Daños adicionales: Cubre granizo, ramas caídas, parabrisas agrietados, fallas mecánicas mayores',
        ],
        'excludes_title' => 'No está cubierto:',
        'excludes' => [
            'alcohol' => 'Conducir bajo la influencia del alcohol o drogas',
            'reckless' => 'Conducción imprudente/ilegal/fuera de carretera',
            'racing' => 'Carreras o uso no autorizado',
            'license' => 'Conducir sin una licencia válida',
            'personal' => 'Objetos personales dejados en el coche',
            'reporting' => 'No informar a la oficina dentro de las 24 h posteriores al accidente',
        ],
        'note' => '** El incumplimiento de cualquiera de estas condiciones le hará completamente responsable de todos los costes de reparación del vehículo.',
    ],

    'excess' => [
        'title' => '2. Franquicia / Deducible del Seguro – Sin Depósito',
        'text' => [
            'no_deposit' => 'No retenemos un depósito en su tarjeta. Solo paga una franquicia si se le considera responsable. La franquicia aparece en la página del vehículo, el presupuesto de alquiler y el contrato.',
            'refund' => 'Si es responsable, debe pagar en 48 h. Si no es responsable (confirmado por la policía/aseguradora), será reembolsado. Los reembolsos pueden tardar 7–14 días tras la confirmación.',
        ],
    ],

    'mdfd' => [
        'title' => '3. Depósito Reembolsable por Daños Menores y Multas (MDFD)',
        'items' => [
            'amount' => 'Rs6,000–Rs15,000 según el tipo de vehículo',
            'coverage' => 'Cubre daños menores y multas de tráfico',
            'refund' => 'Reembolso completo en 14–21 días si no hay multas/daños',
            'tourists' => 'Los turistas deben pagar en línea antes de la entrega (enlace en el correo de reserva)',
        ],
    ],

    'delivery' => [
        'title' => '4. Lugares de Entrega',
        'items' => [
            'airport' => 'Aeropuerto: Encuentro en Paul Coffee Shop en llegadas',
            'hotels' => 'Hoteles: Entrega en recepción',
            'id' => 'Se requiere identificación original y licencia de conducir en todas las entregas',
        ],
    ],

    'requirements' => [
        'title' => '5. Requisitos de Alquiler de Coches',
        'items' => [
            'license' => 'Licencia local o internacional válida',
            'age' => 'Edad entre 21 y 75 años',
            'age_fee' => 'Edad 18–20: Se aplica una tarifa de Rs300/día',
            'model' => 'Los modelos de coches son ejemplos—pueden proporcionarse alternativas similares',
            'inspection' => 'Inspeccione el coche y tome fotos en la entrega',
            'staff' => 'Reúnase solo con personal de GoMauris uniformado',
        ],
    ],

    'return' => [
        'title' => '6. Directrices de Devolución del Coche',
        'items' => [
            'airport' => 'Devolver en la zona de salidas del aeropuerto',
            'no_refund' => 'No hay reembolso por devoluciones anticipadas',
            'late' => 'Devolución tardía: Se cobra después de 3 horas',
            'fuel' => 'Combustible: Devuelva con el mismo nivel o pague Rs400/bar',
            'lost' => 'Objetos perdidos: El envío corre a su cargo',
        ],
    ],

    'amendments' => [
        'title' => '7. Modificaciones de la Reserva',
        'items' => [
            'extensions' => 'Solicite extensiones por correo al menos 48 h antes',
            'alternative' => 'Si el coche no está disponible, proporcionamos uno similar o mejorado',
            'refund' => 'Si no es posible, se otorga un reembolso completo',
        ],
    ],

    'payment' => [
        'title' => '8. Precios y Condiciones de Pago',
        'items' => [
            'period' => 'Las tarifas son por período de 24 horas',
            'minimum' => 'Mínimo de alquiler: 4 días',
            'split' => 'Pague 50% en la reserva, 50% en la entrega',
            'full' => 'Opción de pago total disponible en línea',
            'separate' => 'Enlaces de pago separados para alquiler y MDFD',
        ],
    ],

    'accident' => [
        'title' => '9. En Caso de Accidente',
        'items' => [
            'emergency' => 'Llame a los servicios de emergencia si es necesario (114 para emergencias médicas, 999 para la policía)',
            'photos' => 'Tome fotos/videos de la escena',
            'hotline' => 'Contacte con nuestra línea directa para asistencia',
            'form' => 'Complete el Formulario de Accidente (en la guantera)',
            'exchange' => 'Intercambie información con el otro conductor, firme el formulario y envíenoslo',
            'replacement' => 'Enviaremos una grúa y un coche de reemplazo si el vehículo queda inmovilizado',
            'email' => 'Envíe una copia del formulario a gomauristours@gmail.com en un plazo de 24 h',
        ],
    ],

    'maintenance' => [
        'title' => '10. Alertas de Mantenimiento',
        'items' => [
            'check' => 'Verifique aceite, agua, presión de neumáticos regularmente',
            'long_term' => 'Alquileres a largo plazo: cambios de aceite cada 5,000–10,000 km',
            'replacement' => 'Se proporciona un vehículo de reemplazo durante el mantenimiento',
        ],
    ],

    'mechanical' => [
        'title' => '11. Problemas Mecánicos',
        'items' => [
            'report' => 'Informe los problemas de inmediato para evitar daños adicionales',
            'void' => 'No informar puede anular el reembolso del MDFD',
        ],
    ],

    'assistance' => [
        'title' => '12. Tarifa de Asistencia',
        'items' => [
            'tyres' => 'Neumáticos: Reparación/reemplazo cubiertos. €35 de transporte si vamos a su ubicación',
            'keys' => 'Llaves: Tarifa de reemplazo + €35 de entrega (gratis si lo recoge)',
            'battery' => 'Batería: Recarga = €35 si vamos a su ubicación. Gratis si viene a nuestra oficina',
        ],
    ],

    'cancellation' => [
        'title' => '13. Política de Cancelación / Reembolso',
        'items' => [
            'standard' => 'Estándar: Reembolso completo si cancela con 72+ h de antelación',
            'events' => 'Eventos imprevistos: Reembolso completo menos €15 de tarifa',
            'late' => 'Cancelaciones tardías: 50% de reembolso menos €15 de tarifa',
            'processing' => 'Tiempo de procesamiento: 7–14 días',
            'mdfd' => 'MDFD: Siempre se reembolsa al 100%',
        ],
    ],

    'closing' => '¡Disfrute de una experiencia de alquiler de coches transparente y sin complicaciones con GoMauris!',
];
