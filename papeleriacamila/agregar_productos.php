<?php
// add_products.php
include('db.php'); // Asegúrate de que este archivo esté configurado correctamente

// Definir productos para insertar
$products = [
    [
        'name' => 'Cuaderno A4',
        'price' => 35.00,
        'descripcion' => 'Cuaderno tamaño A4 con hojas de 100 páginas.',
    ],
    [
        'name' => 'Lápiz HB',
        'price' => 5.00,
        'descripcion' => 'Lápiz de grafito HB, ideal para escribir y dibujar.',
    ],
    [
        'name' => 'Bolígrafo Azul',
        'price' => 10.00,
        'descripcion' => 'Bolígrafo de tinta azul, con tinta de secado rápido.',
    ],
    [
        'name' => 'Resaltador Amarillo',
        'price' => 15.00,
        'descripcion' => 'Resaltador amarillo fluorescente, ideal para estudiar.',
    ],
    [
        'name' => 'Goma de borrar',
        'price' => 4.00,
        'descripcion' => 'Goma de borrar suave, perfecta para lápiz.',
    ],
    [
        'name' => 'Marcador Permanente',
        'price' => 12.00,
        'descripcion' => 'Marcador permanente de punta fina, color negro.',
    ],
    [
        'name' => 'Regla 30cm',
        'price' => 8.00,
        'descripcion' => 'Regla de plástico de 30 cm, ideal para dibujar líneas rectas.',
    ],
    [
        'name' => 'Tijeras',
        'price' => 20.00,
        'descripcion' => 'Tijeras de acero inoxidable, con mango ergonómico.',
    ],
];

// Insertar productos en la base de datos
foreach ($products as $product) {
    $query = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sds", $product['name'], $product['price'], $product['description']);
    $stmt->execute();
}

echo "Productos agregados exitosamente.";
?>
