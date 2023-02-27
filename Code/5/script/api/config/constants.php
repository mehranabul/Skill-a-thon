<?php

$defaultLang = 1;
$defaultStep = 1;
date_default_timezone_set("Asia/Calcutta");
$dbNow = date("Y-m-d H:i:s");
$today = date("d.m.Y");
$currMonth = date('F');
$currMonthNum = date('m');
$currYear = date('Y');

$messages = array(
    1 => array(
        "WELCOME" => "Welcome to Rojgaar!<br>Please select your language-<br>Reply with<br>'e' for English<br>'h' for Hindi<br>'b' for Bangla",
        "EXIT" => "Thanks For Using Rojgaar!!!",
        "EMP_OR_JOB" => "You have selected English.<br><br>Select Your User Type-<br>Reply with<br>'ec' for Employer<br>'ei' for Individual Job Giver<br>'js' for Job Seeker",
        "THANKS_FOR_CONFIRM_COMPANY" => "Thanks for Confirming!<br><br>What's your Company Name?",
        "THANKS_FOR_CONFIRM_IND" => "Thanks for Confirming!<br><br>What's your name?",
        "ADD_JOB" => "Thanks for your Name!<br><br>Reply with the following data for the job, you wish to post with us, in comma separated format-<br><br>Job Title, Minimum Experience(in months), Hourly Pay, Job Location",
        "SEARCH_JOB" => "Thanks for your Name!<br><br>Reply with the job title you wish to search with us-",
        "WRONG_INPUT" => "Wrong Input!<br>Please Try Again!",
        "THANKS_FOR_JOB" => "Thanks for adding a job to our database!",
        "CREATED_JOB_ID" => " ID created for your job!",
        "FOUND" => "Found",
        "JOBS" => "Jobs"
    ),
    2 => array(
        "WELCOME" => "रोजगार में आपका स्वागत है!<br>कृपया अपनी भाषा चुनें-<br>उत्तर दें<br>अंग्रेजी के लिये 'e'<br>हिंदी के लिए 'h'<br>बंगला के लिए 'b'",
        "EXIT" => "रोज़गार का उपयोग करने के लिए धन्यवाद!!!",
        "EMP_OR_JOB" => "आपने हिन्दी को चुना है।<br><br>अपना उपयोगकर्ता प्रकार चुनें-<br>उत्तर दें<br>नियोक्ता के लिए 'ec'<br>व्यक्तिगत नौकरी के लिए 'ei'<br>नौकरी चाहने वाले के लिए 'js'",
        "THANKS_FOR_CONFIRM_COMPANY" => "पुष्टि करने के लिए धन्यवाद!<br><br>आपकी कंपनी का नाम क्या है?",
        "THANKS_FOR_CONFIRM_IND" => "पुष्टि करने के लिए धन्यवाद!<br><br>आपका क्या नाम है?",
        "ADD_JOB" => "आपके नाम के लिए धन्यवाद!<br><br>नौकरी के लिए निम्न डेटा के साथ उत्तर दें, आप अल्पविराम से अलग किए गए प्रारूप में हमारे साथ पोस्ट करना चाहते हैं-<br><br>कार्य शीर्षक, न्यूनतम अनुभव (महीनों में), प्रति घंटा वेतन, नौकरी करने का स्थान",
        "SEARCH_JOB" => "आपके नाम के लिए धन्यवाद!<br><br>उस नौकरी के शीर्षक के साथ उत्तर दें जिसे आप हमारे साथ खोजना चाहते हैं-",
        "WRONG_INPUT" => "गलत इनपुट!<br>कृपया पुन: प्रयास करें!",
        "THANKS_FOR_JOB" => "हमारे डेटाबेस में नौकरी जोड़ने के लिए धन्यवाद!",
        "CREATED_JOB_ID" => " आईडी के साथ बनाई गई नौकरी!",
        "FOUND" => "पाई",
        "JOBS" => "नौकरी"
    ),
    3 => array(
        "WELCOME" => "রোজগারে স্বাগতম!<br>আপনার ভাষা নির্বাচন করুন-<br>উত্তর পাঠান<br>ইংরেজির জন্য 'e'<br>হিন্দির জন্য 'h'<br>বাংলার জন্য 'b'",
        "EXIT" => "রোজগার ব্যবহারের জন্য ধন্যবাদ!!!",
        "EMP_OR_JOB" => "আপনি বাংলা নির্বাচন করেছেন।<br><br>আপনার ব্যবহারকারীর ধরন নির্বাচন করুন-<br>উত্তর পাঠান<br>কর্মচারীর জন্য 'ec'<br>ব্যক্তিগত চাকরিদাতার জন্য 'ei'<br>চাকরিপ্রার্থীর জন্য 'js'",
        "THANKS_FOR_CONFIRM_COMPANY" => "জানানোর জন্য ধন্যবাদ!<br><br>আপনার কোম্পানির নাম কি?",
        "THANKS_FOR_CONFIRM_IND" => "জানানোর জন্য ধন্যবাদ!<br><br>আপনার নাম কি??",
        "ADD_JOB" => "আপনার নামের জন্য ধন্যবাদ!<br><br>চাকরির জন্য নিম্নলিখিত ডেটা সহ উত্তর দিন, আপনি আমাদের সাথে পোস্ট করতে চান, কমা বিভক্ত বিন্যাসে-<br><br>চাকরীর শিরোনাম, ন্যূনতম অভিজ্ঞতা (মাসে), ঘন্টায় বেতন, চাকুরি স্থান",
        "SEARCH_JOB" => "আপনার নামের জন্য ধন্যবাদ!<br><br>আপনি যে কাজের শিরোনামটি আমাদের সাথে অনুসন্ধান করতে চান তার সাথে উত্তর দিন-",
        "WRONG_INPUT" => "ভুল ইনপুট!<br>অনুগ্রহপূর্বক আবার চেষ্টা করুন!",
        "THANKS_FOR_JOB" => "আমাদের ডাটাবেসে একটি কাজ যোগ করার জন্য ধন্যবাদ!",
        "CREATED_JOB_ID" => " আইডি দিয়ে চাকরি তৈরি করা হয়েছে!",
        "FOUND" => "পাওয়া গেছে",
        "JOBS" => "চাকরি"
    )
);
