<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

declare(strict_types=1);

namespace Manchenkov\Timer;

/**
 * This class helps build a time interval value in seconds by object-oriented style
 * @package Manchenkov\Timer
 */
final class Timer
{
    /**
     * @var int Seconds value
     */
    private int $value = 0;

    /**
     * Returns instance of this class
     * @return Timer
     */
    public static function get(): Timer
    {
        return new self();
    }

    /**
     * Adds seconds value
     *
     * @param int $value
     *
     * @return $this
     */
    public function seconds(int $value): Timer
    {
        $this->value += $value;

        return $this;
    }

    /**
     * Adds minutes value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function minutes(int $value): Timer
    {
        return $this->seconds($value * 60);
    }

    /**
     * Adds hours value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function hours(int $value): Timer
    {
        return $this->minutes($value * 60);
    }

    /**
     * Adds days value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function days(int $value): Timer
    {
        return $this->hours($value * 24);
    }

    /**
     * Adds weeks value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function weeks(int $value): Timer
    {
        return $this->days($value * 7);
    }

    /**
     * Adds months value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function months(int $value): Timer
    {
        return $this->weeks($value * 4);
    }

    /**
     * Adds years value
     *
     * @param int $value
     *
     * @return Timer
     */
    public function years(int $value): Timer
    {
        return $this->months($value * 12);
    }

    /**
     * Returns an interval value in seconds
     * @return int
     */
    public function asNumber(): int
    {
        return $this->value;
    }

    /**
     * Returns interval value as a string in format HH:MM:SS
     * @return string
     */
    public function asString(): string
    {
        $hours = floor($this->value / 3600);
        $minutes = floor($this->value / 60) - ($hours * 60);
        $seconds = $this->value - ($minutes * 60) - ($hours * 3600);

        $hours = ($hours < 10) ? "0{$hours}" : $hours;
        $minutes = ($minutes < 10) ? "0{$minutes}" : $minutes;
        $seconds = ($seconds < 10) ? "0{$seconds}" : $seconds;

        return "{$hours}:{$minutes}:{$seconds}";
    }

    /**
     * Parses string with a format "HH:MM:SS" into a Timer object
     *
     * @param string $value
     * @param string $separator
     *
     * @return Timer
     */
    public static function parseString(string $value, string $separator = ":"): Timer
    {
        [$hours, $minutes, $seconds] = array_map(
            static function ($str): int {
                return (int) $str;
            },
            explode($separator, $value)
        );

        return self::get()->hours($hours)->minutes($minutes)->seconds($seconds);
    }

    /**
     * Returns bounds of a passed date
     * Example: dayBounds('19.02.19 16:55:00') returns ['19.02.19 00:00:00', '19.02.19 23:59:59'] (as unix timestamp)
     *
     * @param string $date
     *
     * @return array
     */
    public static function dayBounds(string $date): array
    {
        $timestamp = strtotime($date);

        $dayStart = strtotime(date('d.m.Y', $timestamp));
        $dayEnd = strtotime("+23 hours 59 minutes 59 seconds", $dayStart);

        return [$dayStart, $dayEnd];
    }

    public function __toString(): string
    {
        return $this->asString();
    }
}
