<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testArrayRandomOneElement()
    {
        $rand = random_array(['one']);
        $this->assertEquals('one', $rand);
    }

    public function testRun1()
    {
        $this->assertEquals('user@example.com', 'user@example.com');
    }
}