<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Tests;

class CommandlineInterfaceTest extends OpenApiTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    private function runOpenapi(string $args, &$output, &$retval): void
    {
        $bin = escapeshellarg(realpath(__DIR__ . '/../bin/openapi') ?: (__DIR__ . '/../bin/openapi'));
        $php = escapeshellarg(PHP_BINARY);
        $nullDev = DIRECTORY_SEPARATOR === '\\' ? 'NUL' : '/dev/null';
        $cmd = $php . ' ' . $bin . ' ' . str_replace('2> /dev/null', '2> ' . $nullDev, $args);
        exec($cmd, $output, $retval);
    }

    public function testStdout()
    {
        $path = __DIR__ . '/../Examples/swagger-spec/petstore-simple';
        $this->runOpenapi('--format yaml ' . escapeshellarg($path) . ' 2> /dev/null', $output, $retval);
        $this->assertSame(0, $retval);
        $yaml = implode(PHP_EOL, $output);
        $this->assertSpecEquals(file_get_contents($path . '/petstore-simple.yaml'), $yaml);
    }

    public function testOutputTofile()
    {
        $path = __DIR__ . '/../Examples/swagger-spec/petstore-simple';
        $filename = sys_get_temp_dir() . '/swagger-php-clitest.yaml';
        $this->runOpenapi('--format yaml -o ' . escapeshellarg($filename) . ' ' . escapeshellarg($path) . ' 2> /dev/null', $output, $retval);
        $this->assertSame(0, $retval);
        $this->assertCount(0, $output, 'No output to stdout');
        $yaml = file_get_contents($filename);
        unlink($filename);
        $this->assertSpecEquals(file_get_contents($path . '/petstore-simple.yaml'), $yaml);
    }

    public function testAddProcessor()
    {
        $path = __DIR__ . '/../Examples/swagger-spec/petstore-simple';
        $this->runOpenapi('--processor OperationId --format yaml ' . escapeshellarg($path) . ' 2> /dev/null', $output, $retval);
        $this->assertSame(0, $retval);
    }

    public function testExcludeListWarning()
    {
        $path = __DIR__ . '/../Examples/swagger-spec/petstore-simple';
        $this->runOpenapi('-e foo,bar ' . escapeshellarg($path) . ' 2>&1', $output, $retval);
        $this->assertSame(1, $retval);
        $output = implode(PHP_EOL, $output);
        $this->assertStringContainsString('Comma-separated exclude paths are deprecated', $output);
    }

    public function testMissingArg()
    {
        $path = __DIR__ . '/../Examples/swagger-spec/petstore-simple';
        $this->runOpenapi(escapeshellarg($path) . ' -e 2>&1', $output, $retval);
        $this->assertSame(1, $retval);
        $output = implode(PHP_EOL, $output);
        $this->assertStringContainsString('Error: Missing argument for "-e"', $output);
    }
}
