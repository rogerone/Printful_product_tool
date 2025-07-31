<!-- ====================================================================== -->
<!-- ======================= BACKEND: api.php =========================== -->
<!-- ====================================================================== -->
<?php
/*
// api.php
// Aquest fitxer gestiona tota la lògica del servidor.

// Iniciem la sessió per emmagatzemar la clau API i les dades dels productes.
session_start();

// Funció principal que actua com a router.
function handle_request() {
    $action = $_REQUEST['action'] ?? null;

    switch ($action) {
        case 'fetch_products':
            fetch_products();
            break;
        case 'export_csv':
            export_csv();
            break;
        case 'export_xml':
            export_xml();
            break;
        case 'import_products':
            import_products();
            break;
        default:
            send_json_response(['message' => 'Acció no vàlida.'], 400);
    }
}

function send_json_response($data, $status_code = 200) {
    header('Content-Type: application/json');
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

function call_printful_api($endpoint, $method = 'GET', $data = null) {
    if (empty($_SESSION['api_key'])) {
        throw new Exception('La clau API de Printful no està a la sessió.');
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.printful.com/' . $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['api_key'],
        'Content-Type: application/json'
    ]);

    if ($method === 'POST' && $data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $decoded_response = json_decode($response, true);

    if ($http_code < 200 || $http_code >= 300) {
        $error_message = $decoded_response['error']['message'] ?? 'Error de connexió amb Printful.';
        throw new Exception($error_message);
    }

    return $decoded_response;
}

function fetch_products() {
    if (empty($_POST['api_key'])) {
        send_json_response(['message' => 'La clau API és obligatòria.'], 400);
    }
    $_SESSION['api_key'] = $_POST['api_key'];

    try {
        $data = call_printful_api('sync/products');
        $_SESSION['products'] = $data['result'];
        send_json_response(['message' => 'Productes carregats.', 'data' => $data['result']]);
    } catch (Exception $e) {
        send_json_response(['message' => $e->getMessage()], 400);
    }
}

function import_products() {
    if (empty($_FILES['importFile'])) {
        send_json_response(['message' => 'No s\'ha rebut cap fitxer.'], 400);
    }
    if (empty($_SESSION['api_key'])) {
        send_json_response(['message' => 'Si us plau, connecta\'t amb la teva clau API primer.'], 401);
    }

    $file_path = $_FILES['importFile']['tmp_name'];
    $file_type = $_FILES['importFile']['type'];

    if ($file_type !== 'text/csv') {
        send_json_response(['message' => 'Format de fitxer no vàlid. Només s\'accepten arxius CSV.'], 400);
    }

    $products_to_create = [];
    $handle = fopen($file_path, 'r');
    $headers = fgetcsv($handle); // Llegim capçaleres

    // Estructura esperada: product_name, variant_id, retail_price, print_file_url, thumbnail_url
    while (($row = fgetcsv($handle)) !== FALSE) {
        $record = array_combine($headers, $row);
        $product_name = $record['product_name'];

        if (!isset($products_to_create[$product_name])) {
            $products_to_create[$product_name] = [
                'sync_product' => [
                    'name' => $product_name,
                    'thumbnail' => $record['thumbnail_url']
                ],
                'sync_variants' => []
            ];
        }

        $products_to_create[$product_name]['sync_variants'][] = [
            'retail_price' => $record['retail_price'],
            'variant_id' => intval($record['variant_id']),
            'files' => [
                ['type' => 'default', 'url' => $record['print_file_url']]
            ]
        ];
    }
    fclose($handle);

    $success_count = 0;
    $error_count = 0;
    $errors = [];

    foreach ($products_to_create as $product_data) {
        try {
            call_printful_api('store/products', 'POST', $product_data);
            $success_count++;
        } catch (Exception $e) {
            $error_count++;
            $errors[] = "Error en producte '" . $product_data['sync_product']['name'] . "': " . $e->getMessage();
        }
    }

    $message = "Importació completada. Productes creats: $success_count. Errors: $error_count.";
    if($error_count > 0) {
       $message .= " Detalls: " . implode("; ", $errors);
       send_json_response(['message' => $message], 422); // Unprocessable Entity
    } else {
       send_json_response(['message' => $message]);
    }
}

function export_csv() {
    if (empty($_SESSION['products'])) die("No hi ha dades per exportar.");
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="printful_products_' . date('Y-m-d') . '.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['product_id', 'product_name', 'variant_id', 'variant_name', 'sku', 'retail_price', 'currency', 'image_url', 'print_file_url']);
    foreach ($_SESSION['products'] as $product) {
        foreach ($product['sync_variants'] as $variant) {
            fputcsv($output, [
                $product['id'], $product['name'], $variant['id'], $variant['name'],
                $variant['sku'] ?? 'N/A', $variant['retail_price'], $variant['currency'],
                $variant['product']['image'] ?? '', $variant['files'][0]['url'] ?? ''
            ]);
        }
    }
    fclose($output);
}

function export_xml() {
    if (empty($_SESSION['products'])) die("No hi ha dades per exportar.");
    header('Content-Type: application/xml');
    header('Content-Disposition: attachment; filename="printful_products_' . date('Y-m-d') . '.xml"');
    $xml = new SimpleXMLElement('<products/>');
    foreach ($_SESSION['products'] as $product_data) {
        $product_node = $xml->addChild('product');
        $product_node->addAttribute('id', $product_data['id']);
        $product_node->addChild('name', htmlspecialchars($product_data['name']));
        $variants_node = $product_node->addChild('variants');
        foreach ($product_data['sync_variants'] as $variant_data) {
            $variant_node = $variants_node->addChild('variant');
            $variant_node->addAttribute('id', $variant_data['id']);
            $variant_node->addChild('name', htmlspecialchars($variant_data['name']));
            $variant_node->addChild('sku', $variant_data['sku'] ?? 'N/A');
            $variant_node->addChild('price', $variant_data['retail_price']);
            $variant_node->addChild('image_url', $variant_data['product']['image'] ?? '');
        }
    }
    echo $xml->asXML();
}

handle_request();
?>
