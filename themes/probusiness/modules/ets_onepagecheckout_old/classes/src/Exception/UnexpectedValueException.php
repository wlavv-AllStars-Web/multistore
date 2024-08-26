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

namespace Hybridauth\Exception;

if (!defined('_PS_VERSION_')) { exit; }
/**
 * UnexpectedValueException
 *
 * Exception thrown if a value does not match with a set of values. Typically this happens when a function calls
 * another function and expects the return value to be of a certain type or value not including arithmetic or
 * buffer related errors.
 */
class UnexpectedValueException extends RuntimeException implements ExceptionInterface
{
}
