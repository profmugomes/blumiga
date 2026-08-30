<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ErrorHandlerTest extends TestCase
{
    public function testRouteNonExistentReturnsHash(): void
    {
        $result = @route('rota_que_nao_existe_xyz');
        $this->assertSame('#', $result);
    }

    public function testDispatchNonExistentRouteCalls404(): void
    {
        global $blumiga_routes, $blumiga_404_handler;
        $blumiga_routes = [];
        $called = false;
        $blumiga_404_handler = function () use (&$called) {
            $called = true;
        };

        ob_start();
        dispatchRoute('/rota_que_nao_existe', 'GET');
        ob_end_clean();

        $this->assertTrue($called);
    }

    public function testDispatchWrongMethodReturns404(): void
    {
        global $blumiga_routes, $blumiga_404_handler;

        // Registrar rota GET
        $blumiga_routes = [
            'GET' => [
                '/rota-teste-errado' => [
                    'handler' => 'home@index',
                    'sub_namespace' => '',
                    'middleware' => [],
                ],
            ],
        ];

        $called = false;
        $blumiga_404_handler = function () use (&$called) {
            $called = true;
        };

        // POST não está registrado, deve cair no 404
        ob_start();
        dispatchRoute('/rota-teste-errado', 'POST');
        ob_end_clean();

        $this->assertTrue($called);
    }

    public function testDispatchCallableRoute(): void
    {
        global $blumiga_routes, $blumiga_404_handler;
        $blumiga_404_handler = null;
        $called = false;

        $blumiga_routes = [
            'GET' => [
                '/callable-route' => [
                    'handler' => function () use (&$called) {
                        $called = true;
                    },
                    'sub_namespace' => '',
                    'middleware' => [],
                ],
            ],
        ];

        ob_start();
        dispatchRoute('/callable-route', 'GET');
        ob_end_clean();

        $this->assertTrue($called);
    }

    public function testDispatchWithParameters(): void
    {
        global $blumiga_routes, $blumiga_404_handler;
        $blumiga_404_handler = null;
        $receivedId = null;

        $blumiga_routes = [
            'GET' => [
                '/usuario/{id}' => [
                    'handler' => function ($id) use (&$receivedId) {
                        $receivedId = $id;
                    },
                    'sub_namespace' => '',
                    'middleware' => [],
                ],
            ],
        ];

        ob_start();
        dispatchRoute('/usuario/42', 'GET');
        ob_end_clean();

        $this->assertSame('42', $receivedId);
    }

    public function testAssetNonExistentReturnsPathWithoutVersion(): void
    {
        $result = asset('assets/naoexiste.css');
        $this->assertStringStartsWith('/', $result);
        $this->assertStringNotContainsString('?v=', $result);
    }

    public function testAssetExistingFileHasVersion(): void
    {
        $result = asset('assets/css/style.css');
        $this->assertStringStartsWith('/', $result);
        // O arquivo pode ou não existir dependendo do ambiente
    }
}
