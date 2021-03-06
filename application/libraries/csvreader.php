<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* CSVReader Class
*
* $Id: csvreader.php 147 2007-07-09 23:12:45Z Pierre-Jean $
*
* Allows to retrieve a CSV file content as a two dimensional array.
* The first text line shall contains the column names.
*
* @author        Pierre-Jean Turpeau
* @link        http://www.codeigniter.com/wiki/CSVReader
*/
class CSVReader {
    
    var $fields;        /** columns names retrieved after parsing */
    var $separator = ',';    /** separator used to explode each line */
    
    /**
     * Parse a text containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parse_text($p_Text) {
        $lines = explode("\n", $p_Text);
        return $this->parse_lines($lines);
    }
    
    /**
     * Parse a file containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @return    array
     */
    function parse_file($p_Filepath) {
        $lines = file($p_Filepath);
        return $this->parse_lines($lines);
    }
    /**
     * Parse an array of text lines containing CSV formatted data.
     *
     * @access    public
     * @param    array
     * @return    array
     */
    function parse_lines($p_CSVLines) {    
        $content = FALSE;
        foreach( $p_CSVLines as $line_num => $line ) {
            if( $line != '' ) { // skip empty lines
                $elements = explode($this->separator, $line);
 
                if( !is_array($content) ) { // the first line contains fields names
                    $this->fields = $elements;
                    $titulos = array();
                    foreach ($elements as $elemento) {
                    	$titulos[] = $elemento;
                    }
                    $content = array();
                } else {
                    $item = array();
                    /*Con esto los campos se guardan con los titulos de las columnas*/
                    foreach( $this->fields as $id => $field ) {
                        if( isset($elements[$id]) ) {
                            $item[] = $elements[$id];
                            /*Si se desea que los campos tengan el nombre de las columnas se usa:
                             $item[$field] = $elements[$id];
                              */
                        }
                    }
                    $content["titulos"] = $titulos;
                    $content["contenido"][] = $item;
                }
            }
        }
        return $content;
    }
}