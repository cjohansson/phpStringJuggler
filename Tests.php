<?php
/**
 *
 */

/**
 *
 */
namespace StringJuggler
{

    /**
     * Class Tests
     * @package StringJuggler
     */
    class Tests
    {

        /**
         * @internal
         * @static
         * @var int
         */
        private static $_testsCount = 0;

        /**
         * @internal
         * @static
         * @var int
         */
        private static $_testsSuccessCount = 0;

        /**
         * @internal
         * @static
         * @var int
         */
        private static $_testsErrorCount = 0;

        /**
         *
         */
        public function __construct()
        {
            self::_display('\StringJuggler\Tests constructed' . "\n");
            self::testGetAfterPosition();
            self::testGetBeforePosition();
            self::testAfter();
            self::testBefore();
            self::testGetAfter();
            self::testGetBefore();
            self::testNestedExpressions();
        }

        /**
         * @static
         */
        public static function testGetAfter()
        {

            $string = new \StringJuggler\String(
                'Donec id elit non mi porta gravida at eget metus.');

            self::_assertTrue(
                ($response = $string->getAfter('porta ')) == 'gravida at eget metus.',
                'getAfter() test 1, $response = "' . $response . '"',
                true
            );

            self::_assertTrue(
                ($response = $string->getAfter('portas ')) == '',
                'getAfter() test 2, $response = "' . $response . '"',
                true
            );

        }

        /**
         * @static
         *
         */
        public static function testGetBefore()
        {

            $string = new \StringJuggler\String(
                'Donec id elit non mi porta gravida at eget metus.');

            self::_assertTrue(
                ($response = $string->getBefore(' id')) == 'Donec',
                'getBefore() test 1, $response = "' . $response . '"',
                true
            );

            self::_assertTrue(
                ($response = $string->getBefore(' ids')) == '',
                'getBefore() test 2, $response = "' . $response . '"',
                true
            );

        }

        /**
         * @static
         */
        public static function testNestedExpressions()
        {

            $string = new \StringJuggler\String('
                Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta sem malesuada magna mollis euismod.
                Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.
                Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit.
                Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
            ');

            self::_assertTrue(
                ($response = $string
                    ->getAfter('risus')
                    ->getBefore('vel eu')
                    ->getTrimmed()) == 'eget urna mollis ornare',
                'testNestedExpressions() test 1 ($response = "' . $response . '")',
                true
            );

            self::_assertTrue(
                ($response = $string
                    ->getAfter('resus')
                    ->getBefore('vel eu')
                    ->getAfter('ramas')
                    ->getBefore('tito')
                    ->getTrimmed()) == '',
                'testNestedExpressions() test 2 ($response = "' . $response . '")',
                true
            );

        }

        /**
         * @static
         */
        public static function testGetAfterPosition()
        {

            $string = new \StringJuggler\String('blaha YES no');

            $response = $string->getAfterPosition('YES ');

            self::_assertTrue(
                $response === 10,
                'getAfterPosition() test 1, $response = ' . $response,
                true
            );

            $response = $string->getAfterPosition('nope');

            self::_assertTrue(
                $response === false,
                'getAfterPosition() test 2, $response = ' . $response,
                true
            );

        }

        /**
         * @static
         */
        public static function testGetBeforePosition()
        {

            $string = new \StringJuggler\String('blaha YES no');

            $response = $string->getBeforePosition('YES ');

            self::_assertTrue(
                $response === 6,
                'getBeforePosition() test 1, $response = ' . $response,
                true
            );

            $response = $string->getBeforePosition('nope');

            self::_assertTrue(
                $response === false,
                'getBeforePosition() test 2, $response = ' . $response,
                true
            );

        }

        /**
         * @static
         */
        public static function testAfter()
        {

            $string = new \StringJuggler\String('blaha YES no');

            $response = $string->after('YES ');

            self::_assertTrue(
                $response === true && $string == 'no',
                'after() test 1. $response = "' . $response . '", $string = "' . $string . '"',
                true
            );

            $beforeAfter = $string;

            $response = $string->after('.');

            self::_assertTrue(
                $response === false && $string == $beforeAfter,
                'after() test 2. $response = "' . $response . '", $string = "' . $string . '"',
                true
            );

        }

        /**
         * @static
         */
        public static function testBefore()
        {

            $string = new \StringJuggler\String('blaha YES no');

            $response = $string->before(' YES');

            self::_assertTrue(
                $response === true && $string == 'blaha',
                'before() test 1. $response = "' . $response . '"',
                true
            );

            $beforeBefore = $string;

            $response = $string->before('.');

            self::_assertTrue(
                $response === false && $string == $beforeBefore,
                'before() test 2. $response = "' . $response . '"',
                true
            );

        }

        /**
         *
         */
        public function __destruct()
        {
            self::_display("\n" . sprintf(
                'Ran %d tests, %d succeeded and %d failed.',
                self::$_testsCount,
                self::$_testsSuccessCount,
                self::$_testsErrorCount
            ));
            self::_display('\StringJuggler\Tests destructed');
        }

        /**
         * @internal
         * @static
         * @param string $message
         */
        private static function _display($message)
        {
            echo $message . "\n";
        }

        /**
         * @internal
         * @static
         * @param $condition
         * @param $message
         * @param bool|true $displayOnTrue
         */
        private static function _assertTrue($condition, $message, $displayOnTrue = true)
        {
            $testMessage = (!empty($condition) ? 'OK' : 'FAILED') . ' - "' . $message . '".';
            if (empty($condition)
                || (!empty($condition)
                && !empty($displayOnTrue))
            ) {
                self::_display($testMessage);
            }
            self::$_testsCount++;
            if (!empty($condition)) {
                self::$_testsSuccessCount++;
            } else {
                self::$_testsErrorCount++;
            }
        }

    }

}

namespace {
    require_once(__DIR__ . '/StringJuggler.php');
    new \StringJuggler\Tests();
}
