<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 Leandro Lucarella                            |
// +----------------------------------------------------------------------+
// | This source file is subject to the New BSD license, That is bundled  |
// | with this package in the file LICENSE, and is available through      |
// | the world-wide-web at                                                |
// | http://www.opensource.org/licenses/bsd-license.php                   |
// | If you did not receive a copy of the new BSDlicense and are unable   |
// | to obtain it through the world-wide-web, please send a note to       |
// | pear-dev@lists.php.net so we can mail you a copy immediately.        |
// +----------------------------------------------------------------------+
// | Author: Leandro Lucarella <llucax@php.net>                           |
// +----------------------------------------------------------------------+
//
// $Id$
//

require_once 'Date.php';
require_once 'Date/Span.php';
require_once 'PHPUnit/Autoload.php';

/**
 * Test case for Date_Span
 *
 * @package Date
 * @author Leandro Lucarella <llucax@php.net>
 */
class Date_SpanTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Date_Span
     */
    var $time;

    function setUp() {
        $this->time = new Date_Span(97531);
    }

    function tearDown() {
        unset($this->time);
    }

    function testSetFromArray() {
        $this->time->setFromArray(array(5, 48.5, 28.5, 31));
        $this->assertEquals(
            '7:0:59:1',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromString() {
        $this->time->setFromString('5:00:59:31');
        $this->assertEquals(
            '5:0:59:31',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromSeconds() {
        $this->time->setFromSeconds(434344);
        $this->assertEquals(
            '5:0:39:4',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromMinutes() {
        $this->time->setFromMinutes(7860.0166666666);
        $this->assertEquals(
            '5:11:0:1',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromHours() {
        $this->time->setFromHours(50.12345);
        $this->assertEquals(
            '2:2:7:24',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromDays() {
        $this->time->setFromDays(pi());
        $this->assertEquals(
            '3:3:23:54',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testSetFromDateDiff() {
        $this->time->setFromDateDiff(
            new Date('2004-03-10 01:15:59'),
            new Date('2003-03-10 00:10:50')
        );
        $this->assertEquals(
            '366:1:5:9',
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s'))
        );
    }

    function testCopy() {
        $time = new Date_Span();
        $time->copy($this->time);
        $this->assertEquals(
            sprintf('%d:%d:%d:%d', $this->time->format('%D'), $this->time->format('%h'),
                $this->time->format('%m'), $this->time->format('%s')),
            sprintf('%d:%d:%d:%d', $time->format('%D'), $time->format('%h'),
                $time->format('%m'), $time->format('%s'))
        );
    }

    function testFormat() {
        $codes = array(
            'C' => '1, 03:05:31',
            'd' => '1.1288310185185',
            'D' => '1',
            'e' => '27.091944444444',
            'f' => '1625.5166666667',
            'g' => '97531',
            'h' => '3',
            'H' => '03',
            'i' => '3',
            'I' => '03',
            'm' => '5',
            'M' => '05',
            'n' => "\n",
            'p' => 'am',
            'P' => 'AM',
            'r' => '03:05:31 am',
            'R' => '03:05',
            's' => '31',
            'S' => '31',
            't' => "\t",
            'T' => '03:05:31',
            '%' => '%',
        );
        foreach ($codes as $code => $expected) {
            $this->assertEquals(
                "$code: $expected", $this->time->format("$code: %$code")
            );
        }
    }

    function testAdd() {
        $this->time->add(new Date_Span(6000));
        $result = $this->time->toSeconds();
        $expected = 103531;
        $this->assertEquals($expected, $result);
    }

    function testSubtract() {
        $this->time->subtract(new Date_Span(6000));
        $result = $this->time->toSeconds();
        $expected = 91531;
        $this->assertEquals($expected, $result);
    }

}
