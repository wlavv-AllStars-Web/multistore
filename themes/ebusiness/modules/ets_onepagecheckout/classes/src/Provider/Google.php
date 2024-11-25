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

namespace Hybridauth\Provider;

if (!defined('_PS_VERSION_')) { exit; }
use Hybridauth\Adapter\OAuth2;
use Hybridauth\Exception\UnexpectedApiResponseException;
use Hybridauth\Data;
use Hybridauth\User;

class Google extends OAuth2
{
    /**
     * {@inheritdoc}
     */
    public $scope = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';

    /**
     * {@inheritdoc}
     */
    protected $apiBaseUrl = 'https://www.googleapis.com/';

    /**
     * {@inheritdoc}
     */
    protected $authorizeUrl = 'https://accounts.google.com/o/oauth2/auth';

    /**
     * {@inheritdoc}
     */
    protected $accessTokenUrl = 'https://accounts.google.com/o/oauth2/token';

    /**
     * {@inheritdoc}
     */
    protected $apiDocumentation = 'https://developers.google.com/identity/protocols/OAuth2';

    /**
     * {@inheritdoc}
     */
    protected function initialize()
    {
        parent::initialize();

        $this->AuthorizeUrlParameters += array(
            'access_type' => 'offline'
        );

        $this->tokenRefreshParameters += array(
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        );
    }

    /**
     * {@inheritdoc}
     *
     * See: https://developers.google.com/identity/protocols/OpenIDConnect#obtainuserinfo
     */
    public function getUserProfile()
    {
        $response = $this->apiRequest('oauth2/v3/userinfo');

        $data = new Data\Collection($response);

        if (! $data->exists('sub')) {
            throw new UnexpectedApiResponseException('Provider API returned an unexpected response.');
        }

        $userProfile = new User\Profile();

        $userProfile->identifier  = $data->get('sub');
        $userProfile->firstName   = $data->get('given_name');
        $userProfile->lastName    = $data->get('family_name');
        $userProfile->displayName = $data->get('name');
        $userProfile->photoURL    = $data->get('picture');
        $userProfile->profileURL  = $data->get('profile');
        $userProfile->gender      = $data->get('gender');
        $userProfile->language    = $data->get('locale');
        $userProfile->email       = $data->get('email');

        $userProfile->emailVerified = ($data->get('email_verified') === true || $data->get('email_verified') === 1) ? $userProfile->email : '';

        if ($this->config->get('photo_size')) {
            $userProfile->photoURL .= '?sz=' . $this->config->get('photo_size');
        }

        return $userProfile;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserContacts($parameters = array())
    {
        $parameters = array('max-results' => 500) + $parameters;

        // Google Gmail and Android contacts
        if (false !== strpos($this->scope, '/m8/feeds/') || false !== strpos($this->scope, '/auth/contacts.readonly')) {
            return $this->getGmailContacts($parameters);
        }
    }


    /**
     * @param array $parameters
     * @return array
     * @throws \Hybridauth\Exception\HttpClientFailureException
     * @throws \Hybridauth\Exception\HttpRequestFailedException
     * @throws \Hybridauth\Exception\InvalidAccessTokenException
     */
    protected function getGmailContacts($parameters = array())
    {
        $url = 'https://www.google.com/m8/feeds/contacts/default/full?'
            . http_build_query(array_replace(array('alt' => 'json', 'v' => '3.0'), (array)$parameters));

        $response = $this->apiRequest($url);

        if (! $response) {
            return array();
        }

        $contacts = array();

        if (isset($response->feed->entry)) {
            foreach ($response->feed->entry as $entry) {
                $uc = new User\Contact();

                $uc->email = isset($entry->{'gd$email'}[0]->address)
                    ? (string) $entry->{'gd$email'}[0]->address
                    : '';

                $uc->displayName = isset($entry->title->{'$t'}) ? (string) $entry->title->{'$t'} : '';
                $uc->identifier  = ($uc->email != '') ? $uc->email : '';
                $uc->description = '';

                if (property_exists($response, 'website')) {
                    if (is_array($response->website)) {
                        foreach ($response->website as $w) {
                            if ($w->primary == true) {
                                $uc->webSiteURL = $w->value;
                            }
                        }
                    } else {
                        $uc->webSiteURL = $response->website->value;
                    }
                } else {
                    $uc->webSiteURL = '';
                }

                $contacts[] = $uc;
            }
        }

        return $contacts;
    }
}
