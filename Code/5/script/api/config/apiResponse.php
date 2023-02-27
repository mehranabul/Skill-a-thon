<?php

function msgApiError()
{
    http_response_code(404);
    echo json_encode(
        array(
            "message" => "Data Missing",
            "data" => "",
            "success" => false
        )
    );
    exit(0);
}

function reply($data)
{
    http_response_code(200);
    echo json_encode(
        array(
            "data" => $data,
            "success" => true
        )
    );
    exit(0);
}
