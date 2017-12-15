<?php 
    DEFINED('BASEPATH') or exit();

    /**
    * @package Rango Studios Date/Time CI_Library
    * @author  Daniel Omoniyi
    * -----------------------------------------------------------
    * This library makes working with date and time in CI very easy
    */

    class Rango_date
    {
        function __construct()
        {
            // Hello World, nothing's here...
        }

        // Getting readable date and time
        public function get_date_time($format ='', $date_time='', $time='') {
            // Check for unexpected datatypes
            if (is_numeric($format)) {
                throw new Exception("The date format cannot be a numerical value, expecting 'date' or 'time' not $format", 1);
            }

            // Checking required format
            switch ($format) {
                case 'date':
                    $dateString = '%D %M, %Y';
                    $result = mdate( $dateString );
                    return $result;
                break;

                case 'time':
                    $timeString = '%h:%i %a';
                    $result = mdate( $timeString );
                    return $result;
                break;

                case 'elapsed':
                    $getElapsed = $this->_get_elapsed( $date_time );
                    return $getElapsed;
                break;

                default:
                    $dateTimeString = '%D %M, %Y %h:%i %a';
                    $result = mdate( $dateTimeString );
                    return $result;
                break;
            }
        }
        
        // This method returns how much time has passed since a supplied date ($date_time)
        private function _get_elapsed( $date ) {
            // to get the time since that moment
            $time = time() - $date; 
            $time = ( $time < 1 ) ? 1 : $time;
            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ( $tokens as $unit => $text ) {
                if ( $time < $unit ) continue;

                $numberOfUnits = floor( $time / $unit );

                if ( $numberOfUnits <= '1' && $text == 'second' ) {
                    return 'Just now';
                } else if ( $numberOfUnits == '1' && $text == 'day' ) {
                    return 'Yesterday';
                } else if ( $numberOfUnits == '1' && $text == 'week' ) {
                    return 'Last week';
                } else if ( $numberOfUnits == '1' && $text == 'month' ) {
                    return 'Last month';
                } else if ( $numberOfUnits == '1' && $text == 'year' ) {
                    return 'Last year';
                } else {
                    return $numberOfUnits.' '.$text.( ($numberOfUnits>1)?'s ago':'' );
                }
            }
        }
    }