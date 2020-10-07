<?php
/*
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2020
 */

declare(strict_types=1);

namespace Manchenkov\Timer\Tests;

use Manchenkov\Timer\Timer;
use PHPUnit\Framework\TestCase;

final class TimerTest extends TestCase
{
    public function testGetInstance()
    {
        $expected = new Timer();

        self::assertEquals($expected, Timer::get());
    }

    public function testGetInstanceAsAString()
    {
        $expected = '00:00:00';

        $timer = Timer::get();

        self::assertEquals($expected, (string) $timer);
        self::assertEquals($expected, $timer->asString());

        $timer->seconds(50);

        self::assertEquals('00:00:50', $timer->asString());

        $timer->minutes(43);

        self::assertEquals('00:43:50', $timer->asString());

        $timer->hours(3);

        self::assertEquals('03:43:50', $timer->asString());
    }

    public function testSecondsAdd()
    {
        $timer = Timer::get();

        $timer->seconds(60);

        self::assertEquals(60, $timer->asNumber());
    }

    public function testMinutesAdd()
    {
        $timer = Timer::get();

        $timer->minutes(2);

        self::assertEquals(120, $timer->asNumber());
    }

    public function testHoursAdd()
    {
        $timer = Timer::get();

        $timer->hours(2);

        self::assertEquals(60 * 60 * 2, $timer->asNumber());
    }

    public function testDaysAdd()
    {
        $timer = Timer::get();

        $timer->days(1);

        self::assertEquals(60 * 60 * 24, $timer->asNumber());
    }

    public function testWeeksAdd()
    {
        $timer = Timer::get();

        $timer->weeks(1);

        self::assertEquals(60 * 60 * 24 * 7, $timer->asNumber());
    }

    public function testMonthsAdd()
    {
        $timer = Timer::get();

        $timer->months(1);

        self::assertEquals(60 * 60 * 24 * 7 * 4, $timer->asNumber());
    }

    public function testYearsAdd()
    {
        $timer = Timer::get();

        $timer->years(1);

        self::assertEquals(60 * 60 * 24 * 7 * 4 * 12, $timer->asNumber());
    }

    public function testParseFromString()
    {
        $timeString = '01:20:55';

        $timer = Timer::parseString($timeString);

        self::assertEquals((60 * 60 * 1) + (60 * 20) + 55, $timer->asNumber());
        self::assertEquals($timeString, $timer->asString());
    }

    public function testDayBounds()
    {
        $bounds = Timer::dayBounds('01.02.2020 01:20:55');

        $expectedBounds = [
            strtotime('01.02.2020 00:00:00'),
            strtotime('01.02.2020 23:59:59')
        ];

        self::assertEquals($expectedBounds, $bounds);
    }
}
