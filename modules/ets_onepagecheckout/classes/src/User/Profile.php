<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

namespace Hybridauth\User;

if (!defined('_PS_VERSION_')) { exit; }
use Hybridauth\Exception\UnexpectedValueException;

/**
 * Hybridauth\Userobject represents the current logged in user profile.
 */
final class Profile
{
    /**
    * The Unique user's ID on the connected provider
    *
    * @var integer
    */
    public $identifier = null;

    /**
    * User website, blog, web page
    *
    * @var string
    */
    public $webSiteURL = null;

    /**
    * URL link to profile page on the IDp web site
    *
    * @var string
    */
    public $profileURL = null;

    /**
    * URL link to user photo or avatar
    *
    * @var string
    */
    public $photoURL = null;

    /**
    * User displayName provided by the IDp or a concatenation of first and last name.
    *
    * @var string
    */
    public $displayName = null;

    /**
    * A short about_me
    *
    * @var string
    */
    public $description = null;

    /**
    * User's first name
    *
    * @var string
    */
    public $firstName = null;

    /**
    * User's last name
    *
    * @var string
    */
    public $lastName = null;

    /**
    * male or female
    *
    * @var string
    */
    public $gender = null;

    /**
    * Language
    *
    * @var string
    */
    public $language = null;

    /**
    * User age, we don't calculate it. we return it as is if the IDp provide it.
    *
    * @var integer
    */
    public $age = null;

    /**
    * User birth Day
    *
    * @var integer
    */
    public $birthDay = null;

    /**
    * User birth Month
    *
    * @var integer
    */
    public $birthMonth = null;

    /**
    * User birth Year
    *
    * @var integer
    */
    public $birthYear = null;

    /**
    * User email. Note: not all of IDp grant access to the user email
    *
    * @var string
    */
    public $email = null;

    /**
    * Verified user email. Note: not all of IDp grant access to verified user email
    *
    * @var string
    */
    public $emailVerified = null;

    /**
    * Phone number
    *
    * @var string
    */
    public $phone = null;

    /**
    * Complete user address
    *
    * @var string
    */
    public $address = null;

    /**
    * User country
    *
    * @var string
    */
    public $country = null;

    /**
    * Region
    *
    * @var string
    */
    public $region = null;

    /**
    * City
    *
    * @var string
    */
    public $city = null;

    /**
    * Postal code
    *
    * @var string
    */
    public $zip = null;

    /**
    * An extra data which is related to the user
    *
    * @var array
    */
    public $data = array();

    /**
    * Prevent the providers adapters from adding new fields.
    *
    * @var string $name
    * @var mixed  $value
    *
    * @throws UnexpectedValueException
    */
    public function __set($name, $value)
    {
	    unset($value);
        throw new UnexpectedValueException(sprintf('Adding new property "%s" to %s is not allowed.', $name, __CLASS__));
    }
}
