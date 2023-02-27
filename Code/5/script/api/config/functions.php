<?php

function getUserData($uid)
{
    return mysqli_fetch_array(mysqli_query(
        $GLOBALS["com"],
        "SELECT * FROM `user` WHERE uid='" . $uid . "'"
    ));
}

function createUser($uid)
{
    mysqli_query(
        $GLOBALS["com"],
        "INSERT INTO `user`(`uid`, `lang`, `utype`, `step`, `created_on`) 
        VALUES ('" . $uid . "','" . $GLOBALS['defaultLang'] . "', '0', '1', '" . $GLOBALS['dbNow'] . "')"
    );
}

function stop($uid)
{
    mysqli_query(
        $GLOBALS["com"],
        "UPDATE `user` SET
        step = 1
        WHERE uid='" . $uid . "'"
    ) or die(mysqli_error($GLOBALS["com"]));
}

function updateUserLanguage($uid, $lang)
{
    mysqli_query(
        $GLOBALS["com"],
        "UPDATE `user` SET
        lang = '" . $lang . "'
        WHERE uid='" . $uid . "'"
    ) or die(mysqli_error($GLOBALS["com"]));
}

function updateUserType($uid, $type)
{
    mysqli_query(
        $GLOBALS["com"],
        "UPDATE `user` SET
        `utype` = " . (int)$type . "
        WHERE `uid`='" . $uid . "'"
    ) or die(mysqli_error($GLOBALS["com"]));
}

function updateName($uid, $name)
{
    mysqli_query(
        $GLOBALS["com"],
        "UPDATE `user` SET
        `name` = '" . $name . "'
        WHERE `uid`='" . $uid . "'"
    ) or die(mysqli_error($GLOBALS["com"]));
}

function getUserType($uid)
{
    return mysqli_fetch_array(mysqli_query(
        $GLOBALS["com"],
        "SELECT `utype` FROM `user` WHERE uid='" . $uid . "'"
    ))["utype"];
}

function setStep($uid, $step)
{
    mysqli_query(
        $GLOBALS["com"],
        "UPDATE `user` SET
        step='" . $step . "'
        WHERE uid='" . $uid . "'"
    ) or die(mysqli_error($GLOBALS["com"]));
}

function createJob($jobName, $name, $type, $minEx, $pay, $location)
{
    $body = array(
        "id" => "",
        "title" => $jobName,
        "description" => $jobName . " job by " . $name . " on Rojgaar",
        "hiringOrganization" => array(
            "name" => $name
        ),
        "jobLocation" => array(
            "name" => $location,
            "address" => array(
                "name" => $name,
                "addressRegion" => $location
            )
        ),
        "employmentType" => array(
            "Permanent " . $type . " Job"
        ),
        "OccupationalExperienceRequirements" => array(
            array(
                "type" => "minimum",
                "monthsOfExperience" => (int)$minEx ?: 0
            ),
            array(
                "type" => $minEx . " months of working experience"
            )
        ),
        "salary" => array(
            "currency" => "INR",
            "pay" => array(
                array(
                    "maxValue" => (int)$pay ?: 0,
                    "unitText" => "hour",
                    "type" => "basic"
                )
            )
        ),
        "responsibilities" => array(
            "Diligent",
            "Honest",
            "Hard Working"
        ),
        "skills" => array(
            $jobName . " skills"
        )
    );

    $post_data = json_encode($body);

    $crl = curl_init("https://6vs8xnx5i7.execute-api.ap-south-1.amazonaws.com/dsep/jobportal/addjob");
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

    curl_setopt(
        $crl,
        CURLOPT_HTTPHEADER,
        array(
            'x-api-key: ZFP9Re4gEd9uAA1dVSZcV6lZ2KDFcHEx6aOs2uzX',
            'Content-Type: application/json'
        )
    );
    $result = curl_exec($crl);
    curl_close($crl);
    return $result;
}

function getJob($jobName)
{
    $body = array(
        "context" => array(
            "domain" => "dsep:jobs",
            "action" => "search",
            "version" => "1.0.0",
            "bap_id" => "dsep-protocol.becknprotocol.io",
            "bap_uri" => "https://dsep-protocol-network.becknprotocol.io/",
            "transaction_id" => "a9aaecca-10b7-4d19-b640-b047a7c62195",
            "message_id" => "$89bdae17-9942-40c8-869a-5bd413356407",
            "timestamp" => "2022-10-11T09:55:41.161Z",
            "ttl" => "PT30S"
        ),
        "message" => array(
            "intent" => array(
                "item" => array(
                    "descriptor" => array(
                        "name" => $jobName
                    )
                )
            )
        )
    );

    $post_data = json_encode($body);

    $crl = curl_init("https://dsep-protocol-client.becknprotocol.io/search");
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);

    curl_setopt(
        $crl,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json'
        )
    );
    $result = curl_exec($crl);
    curl_close($crl);
    return sizeof(json_decode($result, false)->responses);
}
