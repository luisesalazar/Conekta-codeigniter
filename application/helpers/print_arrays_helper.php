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

if ( ! function_exists('print_r_obj'))
{
    function print_r_obj($arrays) {
        echo "Array:<br/><br/>";
        foreach ($arrays as $i => $array) {
            echo $i." = [ | ";
            
            foreach ($array as $j => $value) {
                echo $j.":".$value." | ";
            }
            echo "] <br/>";
        }
    }
}

if ( ! function_exists('print_r_tbl'))
{
    function print_r_tbl($arrays) {
        echo "Array:<br/><br/>";
        $table="<table>";
        $table.="<tbody>";
        foreach ($arrays as $i => $array) {
            
            
               //$table.="<thead>";
               $table.="<tr>";
               $table.="<td nowrap>".$i." = </td>";
            
            foreach ($array as $j => $value) {
               $table.="<td>".$value." </td>";
            }
            $table.="</tr>";
        }
        $table.="</tbody>";
        $table.="</table>";
        
        echo $table;
    }
}

if ( ! function_exists('print_r_htm'))
{
    function print_r_htm($headers,$arrays) {
        echo "Array:<br/><br/>";
        $table="<table border=1 cellspacing=0 cellpadding=3>";
        $table.="<tbody>";
        $table.="<thead>";
        $table.="<tr>";
        $table.="<th nowrap>&nbsp;</th>";
        
        foreach ($headers as $h => $header) {
            $table.="<th>".$header." </th>";
        }
        
        $table.="</tr>";
        $table.="</thead>";
        
        foreach ($arrays as $i => $array) {
            $table.="<tr>";
            $table.="<td nowrap>".$i."</td>";
            
            foreach ($array as $j => $value) {
               $table.="<td>".$value." </td>";
            }
            $table.="</tr>";
        }
        $table.="</tbody>";
        $table.="</table>";
        
        echo $table;
    }
}

?>
