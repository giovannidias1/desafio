<?php

$path = null;
/**
    Condicional para verificar se a variável $_GET['path'] existe,
    caso exista é inserido o valor nele
**/
if (isset($_GET['path'])) {
    $path = $_GET['path'];
}
$contents = file_get_contents('tickets.json');

$json = json_decode($contents,true);

$method =  $_SERVER['REQUEST_METHOD'];

header('Content-type: application/json');
$body = file_get_contents('php://input');

if ($method === 'GET') {
    /**
        verifica se é nula ou vazia ou se não inteiro (caso haja necessidade)
    **/
    if (is_null($path) || $path === '') {
        /**
            Retorna todos os dados do JSON
        **/
        $json = json_encode($json);
        $json =  json_decode($json,false);
        echo json_encode(setPriority($json));
    } else {
        if ($data = GetById($json, $path)) {
            echo json_encode($data);
        } else {
            echo '[]';
        }
    }
}

function GetById($allData, $ticketId)
{
    
    $count = count($allData);
    /**
        Aqui é rodado um laço que verifica se o numero que venho na variável path é igual ao id do arquivo
    **/
    for ($i = 0; $i < $count; $i++) {
        if ($allData[$i]['TicketID'] == $ticketId) {
            /**
                Aqui ele dá o retorno para não precisar percorrer todos os dados,
                isso vai ajudar no desempenho da aplicação, pois só irá percorrer todos os dados se for necessário 
            **/
            return $allData[$i]['Interactions'];
        }
    }
    /**
        retorna nulo se não encontrar nada
    **/
    return null;
}


function setPriority($data)
{

    if (is_array($data) || is_object($data)) {
        foreach ($data as $index => $ticket) {
            $points = 0;
            $priority = false;
            $interactions = $ticket->Interactions;
            foreach ($interactions as $interaction) {
                $isLastCustumer = false;
                $msg = $interaction->Message;
                $subject = $interaction->Subject;
                $termo = ['recl', "e-bit", "procon", "reclame aqui", "insatisfeito", "cabíveis" . "não receb", "tentativa de contato", "varias vezes", "reclameaqui", "solução", "problema"];
                $count = count($termo);
                /** 
                 Laço que percorre o array com palavras chave de ticket problematico
                 **/
                for ($i = 0; $i < $count; $i++) {
                    $pos = stripos($subject, $termo[$i]);
                    $pos2 = stripos($msg, $termo[$i]);
                    if (($pos !== false) || ($pos2 !== false)) {
                        $priority = true;
                        $points++;
                    }
                }

                $ultimo = end($interaction);
                /** 
                 Verifica a quem enviou a ultima mensagem
                 **/
                if ($ultimo === "Customer") {
                    $isLastCustumer = true;
                }
                $data_inicio = new DateTime($ticket->DateCreate);
                $data_fim = new DateTime($ticket->DateUpdate);
                /** 
                 Resgata diferença entre as datas
                 **/
                $dateInterval = $data_inicio->diff($data_fim);
                $dateInterval = $dateInterval->days;
                if (($priority  === false) && ($dateInterval >= 30) && ($isLastCustumer === true)) {
                    $priority = true;
                    $points++;
                }
            }
            $data[$index]->Points = $points;
            if ($priority === true) {
                $data[$index]->Priority = "Alta";
            } else {
                $data[$index]->Priority = "Baixa";
            }
        }
    }
    $filename = 'tickets.new';
    if (!file_exists($filename)) {
        $codificado = json_encode($data);
        file_put_contents('tickets_new.json', $codificado);
    }


    return $data;
}
