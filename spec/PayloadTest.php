<?php

use SelvinOrtiz\Payload\Payload;

/**
 * Class PayloadTest
 */
class PayloadTest extends PHPUnit_Framework_TestCase
{
    public function test_set()
    {
        $input = [
            'name' => [
                'first' => 'Brad',
                'last'  => 'Bell',
            ],
            'spouse' => [
                'name' => [
                    'first' => 'Brandon',
                    'last'  => 'Kelly'
                ],
                'mood' => 'Happy',
                'age'  => '75',
            ],
            'mood' => 'Angry',
            'age'  => 25,
        ];

        $expectedCopy = $input;

        $payload = new Payload($input);

        $this->assertEquals($input, $expectedCopy);

        $payload->set('gender', 'Other');
        $payload->set('spouse.name.last', 'Bell');

        $expectedCopy['gender']                 = 'Other';
        $expectedCopy['spouse']['name']['last'] = 'Bell';

        $this->assertEquals($expectedCopy, $payload->get());
        $this->assertNotEquals($input, $payload->get());
    }

    public function test_get()
    {
        $input = [
            'name' => [
                'first' => 'Brad',
                'last'  => 'Bell',
            ],
            'spouse' => [
                'name' => [
                    'first' => 'Brandon',
                    'last'  => 'Kelly'
                ],
                'mood' => 'Happy',
                'age'  => '75',
            ],
            'mood' => 'Angry',
            'age'  => 25,
        ];

        $payload = new Payload($input);

        $this->assertEquals($input, $payload->get());
        $this->assertEquals(25, $payload->get('age'));
        $this->assertEquals(75, $payload->get('spouse.age'));
        $this->assertEquals('Kelly', $payload->get('spouse.name.last'));
    }

    public function inspect($data)
    {
        fwrite(STDERR, print_r($data));
    }
}
