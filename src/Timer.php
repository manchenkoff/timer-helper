<?php
/**
 * Created by Artyom Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2019
 */

namespace Manchenkov\Timer;

/**
 * This class helps build a time interval value in seconds by object-oriented style
 * @package Manchenkov\Timer
 */
class Timer
{
    /**
     * @var int Seconds value
     */
    private $value = 0;

    /**
     * Returns instance of this class
     * @return Timer
     */
    public static function get()
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
    public function seconds(int $value)
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
    public function minutes(int $value)
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
    public function hours(int $value)
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
    public function days(int $value)
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
    public function weeks(int $value)
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
    public function months(int $value)
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
    public function years(int $value)
    {
        return $this->months($value * 12);
    }

    /**
     * Returns an interval value in seconds
     * @return int
     */
    public function asNumber()
    {
        return $this->value;
    }

    /**
     * Returns interval value as a string in format HH:MM:SS
     * @return string
     */
    public function asString()
    {
        $hours = floor($this->value / 3600);
        $minutes = floor($this->value / 60) - ($hours * 60);
        $seconds = $this->value - ($minutes * 60) - ($hours * 3600);

        $hours = ($hours < 10) ? "0{$hours}" : $hours;
        $minutes = ($minutes < 10) ? "0{$minutes}" : $minutes;
        $seconds = ($seconds < 10) ? "0{$seconds}" : $seconds;

        return "{$hours}:{$minutes}:{$seconds}";
    }

    public function __toString()
    {
        return $this->asString();
    }
}
