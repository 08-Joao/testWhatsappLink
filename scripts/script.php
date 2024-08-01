<?php

// Caminho para o arquivo que armazena os links
$filename = 'whatsapp_links.json';

// Função para obter o array de links do arquivo
function getLinksFromFile($filename) {
    if (file_exists($filename)) {
        $json = file_get_contents($filename);
        return json_decode($json, true);
    } else {
        return array(
            'https://s.tintim.app/whatsapp/84edaaf3-0ed4-425c-9b62-e8b1b43eba63/5a8439eb-aaeb-4c5c-a5a4-10ff2bf4856d',
            'https://s.tintim.app/whatsapp/cb0f338e-c86d-4610-a449-2c35f7dd07da/2a68e5c1-016a-4249-930a-dc11d487aba5',
            'https://s.tintim.app/whatsapp/4334fccf-a02d-4bf8-adae-2a002b4a4c9d/515c08ca-64dd-467e-93ee-50181d1b5b14',
            'https://s.tintim.app/whatsapp/de39dc70-5e0a-4cf5-bd52-172b6d8bd7ad/a18ccbc7-de2e-4597-8334-4039fb753170'
        );
    }
}

// Função para salvar o array de links no arquivo
function saveLinksToFile($filename, $links) {
    $json = json_encode($links);
    file_put_contents($filename, $json);
}

// Função para obter e atualizar o link
function getWhatsAppLink($filename) {
    $links = getLinksFromFile($filename);
    $firstLink = array_shift($links);
    array_push($links, $firstLink);
    saveLinksToFile($filename, $links);
    return $firstLink;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action']) && $data['action'] === 'getWhatsAppLink') {
        $link = getWhatsAppLink($filename);
        echo json_encode(['link' => $link]);
    }
}
?>
