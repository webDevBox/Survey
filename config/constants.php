<?php

return [
    'RESPONSE_CONSTANTS' => [
        'STATUS_ERROR'=> false,
        'STATUS_SUCCESS'=> true,
        'STATUS_OTHER_ERROR'=> 2,
        'STATUS_ACCOUNT_UNAUTHORIZED'=> 3,
        'STATUS_ACCOUNT_SUSPENDED'=> 4,
        'STATUS_ACCOUNT_DELETED'=> 5,
        'STATUS_INVALID_TOKEN'=> 6,
        'STATUS_INVALID_USER_TYPE'=> 7,
        'STATUS_EMAIL_NOT_VERIFIED'=> 8,
        'STATUS_INVALID_PRODUCT_QUANTITY' => 9,
        'STATUS_INVALID_ORDER_DATA' => 10,
        'STATUS_INVALID_COUPON_CODE' => 11,
        'INVALID_PARAMETERS_CODE' => 422,
        'DISABLE_COMPANY_CODE' => 409,
        'INVALID_PARAMETERS'=> 'Invalid Request Parameters.',
        'RESPONSE_CODE_SUCCESS'=> 200,
        'SIGN_UP_SUCCESS_MESSAGE'=> 'User Sign up successful!',
        'ERROR_EMAIL_EXIST'=> 'Email Already In Use.',
        'ERROR_PHONE_EXIST'=> 'Phone Already In Use.',
        'ERROR_USER_NAME_EXIST'=> 'Username Already In Use.',
        'ERROR_INVALID_CREDENTIALS'=> 'Invalid Credentials.',
        'ERROR_ACCOUNT_SUSPENDED'=> 'Your Account Has Been Suspended.',
        'ERROR_ACCOUNT_DELETED'=> 'Your Account Has Been Deleted.',
        'ERROR_ACCOUNT_UNAUTHORIZED'=> 'Your Account Is Not Authorized Yet.',
        'ERROR_INVALID_EMAIL'=> 'Invalid Email Address.',
        'ERROR_INVALID_USER_TYPE'=> 'Invalid User Type.',
        'ERROR_INVALID_COUPON_CODE'=> 'Invalid Coupon Code.',
        'MSG_LOGGED_IN'=> 'Logged In Successful!',
        'MSG_LOGGED_OUT'=> 'Logged Out',
        'MSG_REGISTERED_SUCCESS'=> 'Account Registered',
        'MSG_REGISTERED_OPERATOR'=> 'Check your email and click on the link to verify',
        'MSG_REGISTERED_CUSTOMER'=> 'Activation code sent. Check your email to verify your account.',
        'MSG_DATA_SAVE'=> 'Data has been saved successfully!',
        'MSG_DATA_UPDATE'=> 'Data has been updated successfully!',
        'MSG_DISABLE_COMPANY' => 'Company has been disabled!',
        'MSG_DISABLE_LOCATION' => 'Location has been disabled! You can\'t Login, Please contact with Administration. Thankyou!',
    ],

    //---------Constants for authorization/login
    'AUTH_CONSTANTS' => [
        'KEY_EMAIL'     =>  'email',
        'KEY_PASSWORD'  =>  'password',
    ],

    //--------User constants
    'USER_CONSTANTS' => [
        'KEY_USER_ID'     =>  'id',
        'KEY_USER_USERNAME'     =>  'username',
        'KEY_USER_EMAIL'     =>  'email',
        'KEY_USER_PHONE'     =>  'phone',
        'KEY_USER_DEVICE_ID'     =>  'device_id',
        'KEY_USER_DEVICE_TYPE'     =>  'device_type',

    ],

    'PAGINATION_CONSTANTS' => [
        'KEY_RECORD_PER_PAGE'     =>  10,
    ],

    'PAGINATION_CONSTANTS_WEB' => [
        'KEY_RECORD_PER_PAGE'     =>  10,
    ],

    'REPORT_VIDEO_USER' => [
        'VIDEO_REPORT_COUNT'     =>  5,
        'USER_REPORT_COUNT'     =>  10,
    ],

    'RECORD_LIMIT' => [
        'RECORD_LENGTH'     =>  10,
    ],

    'COMPANY' => [
        'DASHBOARD' => [
            'LATEST_RESPONSE' => 5,
        ],
    ],
];
