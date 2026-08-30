<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class EncryptDecryptTest extends TestCase
{
    public function testEncryptDecryptRoundtrip(): void
    {
        $key = 'minha-chave-secreta';
        $data = 'dados sensíveis';
        $encrypted = encrypt($data, $key);
        $decrypted = decrypt($encrypted, $key);
        $this->assertSame($data, $decrypted);
    }

    public function testEncryptDecryptEmptyString(): void
    {
        $key = 'chave-teste';
        $encrypted = encrypt('', $key);
        $this->assertSame('', decrypt($encrypted, $key));
    }

    public function testDecryptWrongKeyReturnsFalse(): void
    {
        $encrypted = encrypt('secreto', 'chave-certa');
        $this->assertFalse(decrypt($encrypted, 'chave-errada'));
    }

    public function testDecryptInvalidBase64ReturnsFalse(): void
    {
        $this->assertFalse(decrypt('invalid-base64!!!', 'key'));
    }

    public function testDecryptEmptyStringReturnsFalse(): void
    {
        $this->assertFalse(decrypt('', 'key'));
    }

    public function testEncryptReturnsBase64String(): void
    {
        $result = encrypt('teste', 'key');
        $this->assertIsString($result);
        $this->assertNotFalse(base64_decode($result, true));
    }

    public function testEncryptDifferentOutputs(): void
    {
        $key = 'key';
        $a = encrypt('data', $key);
        $b = encrypt('data', $key);
        // IV aleatório torna cada criptografia única
        $this->assertNotSame($a, $b);
    }

    public function testDecryptTamperedMacReturnsFalse(): void
    {
        $encrypted = encrypt('dados', 'key');
        $decoded = base64_decode($encrypted, true);
        // Alterar último byte (parte do MAC)
        $decoded[-1] = chr(ord($decoded[-1]) ^ 0xFF);
        $tampered = base64_encode($decoded);
        $this->assertFalse(decrypt($tampered, 'key'));
    }
}
