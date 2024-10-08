<?php
namespace App\Services;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JWTService {
    private $key;

    public function __construct() {
        $key = env('JWT_KEY'); // 密钥
        if (empty($key)){
            throw new HttpException(500,'请配置jwt密钥');
        }
        $this->key = $key;
    }

    public function generateJWT($username) {
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => time(),
            'exp' => time() + 3600, // 1小时后过期
            'username' => $username
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function verifyJWT($jwt) {
        try {
            $decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}
