<?php
/**
 * Created as Errors.php.
 * Developer: Hamza Waqas
 * Date:      6/25/13
 * Time:      5:08 PM
 */

namespace Logilim;

class Errors {

    const ERR_TOKEN_INVALID = '001';

    const ERR_TOKEN_EXPIRED = '002';

    const ERR_TOKEN_MISSING = '003';

    const ERR_FDV_MISSING   = '004';

    const ERR_FDV_DEPRECATED = '005';

    const ERR_FDV_INVALID    = '006';

    const ERR_INVALID_CONTENT_TYPE = '007';

    const ERR_INVALID_PASSWORD  = '008';

    const ERR_MISSING_PARAMETERS = '009';

    const ERR_EXISTING_EMAIL	=	'010';

    const ERR_UPDATE_USER		=	'011';

    const ERR_USERID_INVALID	=	'012';

    const ERR_JOB_CREATION		=	'013';

    const ERR_BOOKING_CONFIRM	=	'014';

    const ERR_REVIEW_SAVED		=	'015';

    const ERR_BID_CREATION	=	'016';

    const ERR_BID_ACCEPT	=	'017';

    const ERR_BID_NOTFOUND	=	'018';

    const ERR_UNKNOWN_EXCEPTION = '019';

    const ERR_NON_EXISTING_EMAIL = '020';

    const ERR_FAIL_EMAIL_ALERT = '021';

    static function errorDescription($errCode) {

        $desc = array(

            self::ERR_TOKEN_INVALID     => 'Invalid Token or does not exist in our system',
            self::ERR_TOKEN_EXPIRED     => 'Your Token has been expired. Please refresh and try again',
            self::ERR_TOKEN_MISSING     => 'Missing token as "FD-Token" in Request Headers',
            self::ERR_FDV_MISSING       => 'Missing version as "FD-Version" in Request Headers',
            self::ERR_FDV_DEPRECATED    => 'Your API version has been deprecated. Please switch to '.STABLE_API_VERSION,
            self::ERR_FDV_INVALID       => 'Seems, you love to send bogus version. No version found as per Request Header',
            self::ERR_INVALID_CONTENT_TYPE  => 'Invalid Content-Type defined in Request Header. Application only accepts "application/json"',
            self::ERR_INVALID_PASSWORD   => 'Invalid Password against given email.',
            self::ERR_MISSING_PARAMETERS    => 'Your Request Body is missing some required Parameters.',
            self::ERR_EXISTING_EMAIL	=>	'Given Email Address already exists.',
            self::ERR_UPDATE_USER		=>	'Unable to update user account. Please report an issue.',
            self::ERR_USERID_INVALID	=>	'UserID Invalid and/or does not exists.',
            self::ERR_JOB_CREATION		=>	'Unable to create a new job. Please report an issue.',
            self::ERR_BOOKING_CONFIRM	=>	'Unable to confirm a job. Please report an issue.',
            self::ERR_REVIEW_SAVED		=>	'Unable to save your reviews. Please report an issue.',
            self::ERR_BID_CREATION      => 'Error occurred to Create a new Bid.',
            self::ERR_BID_ACCEPT	    =>	'Cannot Update Bid as Accepted.',
            self::ERR_BID_NOTFOUND	    =>	'Bid not Found.',
            self::ERR_UNKNOWN_EXCEPTION => 'Unknown exception occurred while processing your request!',
            self::ERR_NON_EXISTING_EMAIL => 'Given email address does not exist.',
            self::ERR_FAIL_EMAIL_ALERT  => 'Unable to send an email to user. Please Try again!'
        );

        if ( $errCode == null)

            return '';

        if ( array_key_exists($errCode, $desc))

            return $desc[$errCode];

        return '';

    }
}