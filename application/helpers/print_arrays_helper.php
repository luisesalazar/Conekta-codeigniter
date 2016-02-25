<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of print_arrays_helper
 *
 * @author luis
 */

if ( ! function_exists('print_r_uni'))
{
    function print_r_uni($array) {
        echo "Array:<br/><br/>";
        foreach ($array as $key => $value) {
            echo $key." = [ ".$value." ] <br/>";
	}
    }
}

if ( ! function_exists('print_r_pre'))
{
    function print_r_pre($array) {
        echo "<pre>";
	    print_r($array);
	echo "</pre>";
    }
}

if ( ! function_exists('print_r_pre_d'))
{
    function print_r_pre_d($array) {
        echo "<pre>";
	    print_r($array);
	echo "</pre>";
	die();
    }
}

if ( ! function_exists('print_r_bidi'))
{
    function print_r_bidi($arrays) {
        echo "Array:<br/><br/>";
        foreach ($arrays as $i => $array) {
            echo $i." = [ ";

            foreach ($array as $j => $value) {
                echo $value." ";
            }
            echo "] <br/>";
        }
    }
}
?>
