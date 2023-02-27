<?php

require_once("./config/connect.php");
require_once("./config/constants.php");
require_once("./config/apiResponse.php");
require_once("./config/functions.php");

if (!empty($_GET['data']) && !empty($_GET['user'])) {

    $uid = $_GET['user'];
    $input = strtolower($_GET['data']);

    $userData = getUserData($uid);
    $user = $userData['uid'];
    $name = $userData['name'];
    $step = (int)$userData['step'];
    $lang = (int)$userData['lang'];
    $uType = (int)$userData['utype'];

    if (in_array($input, array("stop"))) {
        setStep($uid, 1);
        reply($messages[$lang]["EXIT"]);
    }

    if (!empty($user)) {
        // user exists

        if (in_array($input, array("hi", "hello", "नमस्ते", "হ্যালো"))) {
            setStep($uid, 2);
            reply($messages[$defaultLang]["WELCOME"]);
        } else if ($step == 2) {
            if ($input == "b") {
                $lang = 3;
                updateUserLanguage($uid, 3);
            } else if ($input == "h") {
                $lang = 2;
                updateUserLanguage($uid, 2);
            } else if ($input == "e") {
                $lang = 1;
                updateUserLanguage($uid, 1);
            } else {
                reply($messages[$lang]["WRONG_INPUT"] . "<br><br>" . $messages[$lang]["WELCOME"]);
            }
            setStep($uid, 3);
            reply($messages[$lang]["EMP_OR_JOB"]);
        } else if ($step == 3) {
            if ($input == "ec") {
                setStep($uid, 4);
                updateUserType($uid, 1);
                reply($messages[$lang]["THANKS_FOR_CONFIRM_COMPANY"]);
            } else if ($input == "ei") {
                setStep($uid, 4);
                updateUserType($uid, 2);
                reply($messages[$lang]["THANKS_FOR_CONFIRM_IND"]);
            } else if ($input == "js") {
                setStep($uid, 4);
                updateUserType($uid, 3);
                reply($messages[$lang]["THANKS_FOR_CONFIRM_IND"]);
            } else {
                reply($messages[$lang]["WRONG_INPUT"] . "<br><br>" . $messages[$lang]["EMP_OR_JOB"]);
            }
        } else if ($step == 4) {
            updateName($uid, $input);
            setStep($uid, 5);
            if ($uType == 1)
                reply($messages[$lang]["ADD_JOB"]);
            else if ($uType == 2)
                reply($messages[$lang]["ADD_JOB"]);
            else if ($uType == 3)
                reply($messages[$lang]["SEARCH_JOB"]);
        } else if ($step == 5) {
            setStep($uid, 1);
            $jobData = explode(",", $input);
            if ($uType == 1) {
                reply(createJob($jobData[0], $name, "company", $jobData[1], $jobData[2], $jobData[3]) . "<br>" . $messages[$lang]["CREATED_JOB_ID"] . "<br><br>" . $messages[$lang]["THANKS_FOR_JOB"] . "<br><br>" . $messages[$lang]["EXIT"]);
            } else if ($uType == 2) {
                reply(createJob($jobData[0], $name, "individual", $jobData[1], $jobData[2], $jobData[3]) . "<br>" . $messages[$lang]["CREATED_JOB_ID"] . "<br><br>" . $messages[$lang]["THANKS_FOR_JOB"] . "<br><br>" . $messages[$lang]["EXIT"]);
            } else if ($uType == 3) {
                reply($messages[$lang]["FOUND"] . " " . getJob($jobData[0]) . " " . $messages[$lang]["JOBS"] . "<br><br>" . $messages[$lang]["EXIT"]);
            }
        }
    } else {
        // no user present
        createUser($uid);
        if (in_array($input, array("hi", "hello", "नमस्ते", "হ্যালো"))) {
            setStep($uid, 2);
            reply($messages[$defaultLang]["WELCOME"]);
        }
    }
} else {
    msgApiError();
}
