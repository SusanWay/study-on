<?php

namespace App\Service;

use App\Exception\BillingUnavailableException;
use JsonException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use App\DTO\UserDTO;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;

class BillingClient
{

    private string $url;

    public function __construct()
    {
        $this->url = $_ENV['BILLING_SERVER'];
    }

    /**
     * @throws JsonException
     * @throws BillingUnavailableException
     */
    public static function getToken(string $url, string $credentials, bool $register): array
    {

        if ($register === true) {
            $uri = $url . 'api/v1/register';
        } else {
            $uri = $url . 'api/v1/auth';
        }
        $curl = curl_init($uri);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_POSTFIELDS,
            $credentials
        );


        $response = curl_exec($curl);
        curl_close($curl);

        if ($response !== false) {
            return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        }
        throw new BillingUnavailableException('Сервис временно не доступен! Попытайтесь чуть позже!');
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function getBillingUser(string $token): array
    {

        $uri = $this->url . 'api/v1/users/current';
        return CurlMaker::get($uri, $token);
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function getCourse(string $code): array
    {
        $uri = $this->url . 'api/v1/courses/' . $code;
        return CurlMaker::get($uri);
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function getCourses(): array
    {
        $uri = $this->url . 'api/v1/courses';
        return CurlMaker::get($uri);
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function getTransactions(string $token, array $filter = null): array
    {
        $uri = $this->url . 'api/v1/transactions?' . http_build_query($filter);
        return CurlMaker::get($uri, $token);
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function register(string $credentials): array
    {
        $uri = $this->url . 'api/v1/register';

        return CurlMaker::post($uri, $credentials);
    }

    /**
     * @throws BillingUnavailableException
     * @throws JsonException
     */
    public function buyCourse(string $token, string $code): array
    {
        $uri = $this->url . 'api/v1/courses/' . $code . '/pay';
        return CurlMaker::post($uri, null, $token);
    }

}