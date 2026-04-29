<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['error' => 'JSON inválido']);
    exit;
}

$nome        = isset($input['nome'])        ? $input['nome']        : '';
$email       = isset($input['email'])       ? $input['email']       : '';
$empresa     = isset($input['empresa'])     ? $input['empresa']     : '';
$telefone    = isset($input['telefone'])    ? $input['telefone']    : '';
$cnpj        = isset($input['cnpj'])        ? $input['cnpj']        : '';
$objetivo    = isset($input['objetivo'])    ? $input['objetivo']    : '';
$faturamento = isset($input['faturamento']) ? $input['faturamento'] : '';
$quando      = isset($input['quando'])      ? $input['quando']      : '';
$utms        = isset($input['utms'])        ? $input['utms']        : [];

$TOKEN     = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjA4MzUzYWNhYWU0NDYzNzg0NTdmNWQ4YTFmNTJmNWVjZTRiNDI0NTM3NGI2MjM4NmNlMWU4NjNmODc3YTBhMzMzNGY1YTcwODk1ZDdiZjI1In0.eyJhdWQiOiJmZDkxNWUyYS00M2QzLTQxZDYtYWUzYy1kNTNjOWJjZDA5NjQiLCJqdGkiOiIwODM1M2FjYWFlNDQ2Mzc4NDU3ZjVkOGExZjUyZjVlY2U0YjQyNDUzNzRiNjIzODZjZTFlODYzZjg3N2EwYTMzMzRmNWE3MDg5NWQ3YmYyNSIsImlhdCI6MTc3NTY2NjYxMiwibmJmIjoxNzc1NjY2NjEyLCJleHAiOjE4MzA5MDI0MDAsInN1YiI6IjE0MjYwMDU5IiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjM1NTg2NjM1LCJiYXNlX2RvbWFpbiI6ImtvbW1vLmNvbSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJwdXNoX25vdGlmaWNhdGlvbnMiLCJmaWxlcyIsImNybSIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiZWYyYmQzNDQtNWMwYy00NGI1LTlmZTAtNjJiNWQ0ZjgyNGZlIiwiYXBpX2RvbWFpbiI6ImFwaS1jLmtvbW1vLmNvbSJ9.oeQZKVFXG2caHHvv5b4ASFA9GN4Y2WbUE-U8rU4oZGg3pq1qINq3uUWFBykHx6_ItH4tJHkmNR41dUlvU99uSG3jg0l6qZiae_fUzzSxaT_1ehrdFn-De3x2l52KRhy_Wxeu8F2O_VcYJsG6MZPqwbey3bBfzes-_2I3bPHIUmjD3qGSTeg5V1O-Z3O2n87DClSlDu7hiPhO_XIZ9pcJF5Vlx8_Ds65v5bgdwREKDJh1qG4WKQpkqhUj1BLK8ZhVDSDSN3mL0srzgmjpwcbVFNnJ4EejFqjI36PNBi8bWrk16C8xXVGJZvM-m9BcCaq31avB_buzoY5M_YhB9bpWiQ';
$SUBDOMAIN = 'comercialgmmkt';

$FIELD_CNPJ        = 3889840;
$FIELD_OBJETIVO    = 3889842;
$FIELD_FATURAMENTO = 3889844;
$FIELD_QUANDO      = 3889846;

// Tags dos UTMs
$utmTags = [];
if (!empty($utms['utm_source']))   $utmTags[] = ['name' => 'src:' . $utms['utm_source']];
if (!empty($utms['utm_medium']))   $utmTags[] = ['name' => 'mid:' . $utms['utm_medium']];
if (!empty($utms['utm_campaign'])) $utmTags[] = ['name' => 'cmp:' . $utms['utm_campaign']];
if (!empty($utms['utm_content']))  $utmTags[] = ['name' => 'cnt:' . $utms['utm_content']];
if (!empty($utms['utm_term']))     $utmTags[] = ['name' => 'trm:' . $utms['utm_term']];

// Nota com UTMs
$utmNote = '';
if (!empty($utms)) {
    $lines = ['UTMs do Lead:'];
    foreach ($utms as $k => $v) {
        $lines[] = $k . ': ' . $v;
    }
    $utmNote = implode("\n", $lines);
}

$payload = json_encode([[
    'name' => $empresa,
    'custom_fields_values' => [
        ['field_id' => $FIELD_CNPJ,        'values' => [['value' => $cnpj]]],
        ['field_id' => $FIELD_OBJETIVO,    'values' => [['value' => $objetivo]]],
        ['field_id' => $FIELD_FATURAMENTO, 'values' => [['value' => $faturamento]]],
        ['field_id' => $FIELD_QUANDO,      'values' => [['value' => $quando]]]
    ],
    '_embedded' => [
        'tags'     => $utmTags,
        'contacts' => [[
            'name' => $nome ?: $empresa,
            'custom_fields_values' => [
                [
                    'field_code' => 'PHONE',
                    'values' => [['value' => $telefone, 'enum_code' => 'WORK']]
                ],
                [
                    'field_code' => 'EMAIL',
                    'values' => [['value' => $email, 'enum_code' => 'WORK']]
                ]
            ]
        ]]
    ]
]]);

$ch = curl_init("https://{$SUBDOMAIN}.kommo.com/api/v4/leads/complex");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $TOKEN,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);

if ($httpCode >= 200 && $httpCode < 300) {
    // Adiciona nota com UTMs
    $leadId = isset($data[0]['id']) ? $data[0]['id'] : null;
    if (!$leadId) $leadId = isset($data['_embedded']['leads'][0]['id']) ? $data['_embedded']['leads'][0]['id'] : null;

    if ($utmNote && $leadId) {
        $notePayload = json_encode([[
            'note_type' => 'common',
            'params'    => ['text' => $utmNote]
        ]]);

        $ch2 = curl_init("https://{$SUBDOMAIN}.kommo.com/api/v4/leads/{$leadId}/notes");
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_POST, true);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $notePayload);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $TOKEN,
            'Content-Type: application/json'
        ]);
        curl_exec($ch2);
        curl_close($ch2);
    }

    echo json_encode(['status' => 'ok', 'leadId' => $leadId]);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'details' => $response]);
}
