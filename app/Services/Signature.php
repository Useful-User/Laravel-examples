<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Signature
{

    /**
     * Key to generate hash
     *
     * @var int
     */
    private $key;

    /**
     * Create a new signature instance.
     *
     * @return void
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Create signature
     * 
     * @param array $data
     * @return string
     */
    public function generate(array $data): string
    {
        // There should be normal hash generation logic here
        ksort($data);
        $s = json_encode($data);
        return hash_hmac('sha256', $s, $this->key);
    }

    /**
     * Check given signature
     * 
     * @param array $data
     * @param string $signature
     * @return bool
     */
    public function check(array $data, string $signature): bool
    {
        if (empty($signature)) {
            return false;
        }
        return hash_equals($this->generate($data), $signature);
    }

    /**
     * Generate unique token
     * 
     * @param string $tablename
     * @return string
     */
    public static function uniqueToken(string $tablename)
    {
        do {
            $token  = Str::random(10);
            $validator = Validator::make(['token' => $token], [
                'token' => "required|unique:$tablename",
            ]);
        } while ($validator->fails());
        return $token;
    }

    /**
     * Generate internal signature
     * 
     * @param string $token
     * @return string
     */
    public static function internalSignature(string $token)
    {
        $signature = new Signature(config('app.internal_key'));
        return $signature->generate(['token' => $token]);
    }
}
