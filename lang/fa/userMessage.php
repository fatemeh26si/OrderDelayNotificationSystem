<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'delayed' =>[
        'was_not_delayed' => 'در حال حاضر برای تحویل این سفارش تاخیری پیش نیامده. لطفا صبور باشید.',
        'error_new_delivery_time' => "شما قبلا برای این سفارش درخواست ثبت کرده اید. درصورتی که تا ساعت time: سفارش به دستتان نرسید، مجددا درخواست خود رو ثبت نمایید. ",
        'duplicate_request' => 'َسفارش شما قبلا در صف تاخیر قرار گرفته است. لطفا تا بررسی تیم پشتیبانی شکیبا باشید.',
        'submit_request_in_queue' => 'َسفارش شما در صف تاخیر قرار گرفت. لطفا تا بررسی تیم پشتیبانی شکیبا باشید.',
        'new_delivery_time' => " کاربر گرامی از تاخیر پیش آمده متاسفیم. سفارش شما تا eta: دقیقه دیگر تحویل میگردد."

    ],

//    'accepted_if' => 'زمانی که گزینه :other برابر :value است :attribute باید تایید شود',

];
