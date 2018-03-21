<?php

use StringJuggler\Juggler;

/**
 * Unit testing.
 *
 * @author Cami Mostajo
 * @package TenQuality\Utility\Colors
 * @license MIT
 * @version 1.0.1
 */
class JugglerTest extends PHPUnit_Framework_TestCase
{
    public function testGetAfter()
    {
        // Prepare
        $string = new Juggler('Donec id elit non mi porta gravida at eget metus.');
        // Assert
        $this->assertEquals('gravida at eget metus.', $string->getAfter('porta '));
        $this->assertTrue($string->getAfter('portas ')->isEmpty());
    }
    public function testGetBefore()
    {
        // Prepare
        $string = new Juggler('Donec id elit non mi porta gravida at eget metus.');
        // Assert
        $this->assertEquals('Donec', $string->getBefore(' id'));
        $this->assertTrue($string->getAfter(' ids')->isEmpty());
    }
    public function testNestedExpressions()
    {
        // Prepare
        $string = new Juggler('
            Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod.
            Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.
            Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit.
            Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
        ');
        // Assert
        $this->assertEquals(
            'eget urna mollis ornare',
            $string->getAfter('risus')->getBefore('vel eu')->getTrimmed()
        );
        $this->assertTrue(
            $string->getAfter('resus')
                ->getBefore('vel eu')
                ->getAfter('ramas')
                ->getBefore('tito')
                ->getTrimmed()
                ->isEmpty()
        );
    }
    public function testGetAfterPosition()
    {
        // Prepare
        $string = new Juggler('blaha YES no');
        // Assert
        $this->assertEquals(10, $string->getAfterPosition('YES '));
        $this->assertFalse($string->getAfterPosition('nope'));
    }
    public function testGetBeforePosition()
    {
        // Prepare
        $string = new Juggler('blaha YES no');
        // Assert
        $this->assertEquals(6, $string->getBeforePosition('YES '));
        $this->assertFalse($string->getAfterPosition('nope'));
    }
    public function testAfter()
    {
        // Prepare
        $string = new Juggler('blaha YES no');
        // Execute
        $response = $string->after('YES ');
        // Assert
        $this->assertTrue($response);
        $this->assertEquals('no', $string);

        // Execute Second round
        $beforeAfter = $string;
        $response = $string->after('.');
        // Assert
        $this->assertFalse($response);
        $this->assertEquals($string, $beforeAfter);
    }
    public function testBefore()
    {
        // Prepare
        $string = new Juggler('blaha YES no');
        // Execute
        $response = $string->before(' YES');
        // Assert
        $this->assertTrue($response);
        $this->assertEquals('blaha', $string);

        // Execute Second round
        $beforeAfter = $string;
        $response = $string->after('.');
        // Assert
        $this->assertFalse($response);
        $this->assertEquals($string, $beforeAfter);
    }
}