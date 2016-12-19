<?php

$table = filter_var($_GET['table'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

function sanitizeArray($array)
{
    foreach ($array as $value)
    {
        $return[] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    return $return;
}

$columnnames = sanitizeArray($_GET['columns']);
$values = sanitizeArray($_GET['values']);


/* Insert mit preperd Statement dynamisch
 * 
 * @param type $table : Tabellenname String
 * @param type $columnnames : Spaltennamen, Array aus Strings
 * @param type $values : Array aus Werten für die Spalten, Reihenfolge beachten.
 * z.B. 'ss' .. beide values sind Strings oder
 * 'dib' erster Wert.. double, zweiter integer, dritter blob
 * @param type $connection : Datenbankverbindung
 */


insertStatement($table, $columnnames, $values);

function insertStatement($table, $columnnames, $values, $databaseconnection = null)
{

    /**
     * findet die Typen in dem übergebenen Array
     * liefert z.B: sis oder iis für integer, integer, string
     * @param type $values : Array aus Werten
     */
    function findTypes($values)
    {
        $types = '';
        foreach ($values as $value)
        {
            $types.=gettype($value)[0];
        }
        return $types;
    }

    /**
     * Gibt die benötigte Anzahl ? für das Statement zurück
     * @param type $count
     * @return type
     */
    function writeQuestionmarks($count)
    {
        for ($index = 0; $index < $count; $index++)
        {
            $string[] = '?';
        }

        return implode(',', $string);
    }

    if ($databaseconnection == null)
    {
        //opens connection
        $connection = new mysqli('127.0.0.1', 'markus', 'markus', 'alexandertechnik');
        if ($connection->connect_error)
        {
            echo 'Fehler: ' . $connection->error . '<br>';
        } else
        {
            echo 'connected!<br>';
        }
    }

    //generiert die erforderlichen Fragezeichen
    $questionmarks = writeQuestionmarks(count($columnnames));

    //Array Columnnames to String
    $columnnames = implode(',', $columnnames);


    //prepare statemant
    $statement = $connection->prepare('Insert into ' . $table . ' (' . $columnnames . ') values(' . $questionmarks . ')');


    //findet die typen zu den Werten
    $types = findTypes($values);
    
    //stellt $types an erste Stelle
    array_unshift($values, $types);


    //call_user_func_array erwartet an erster Stelle einen String
    // und alle weiteren werte müssen referenzen sein       
    for ($index = 0; $index < count($values); $index++)
    {
        if ($index != 0)
        {
            $handover[] = &$values[$index];
        } else
        {
            $handover[] = $values[$index];
        }
    }

    call_user_func_array(array($statement, 'bind_param'), $handover);

    if ($statement->execute())
    {
        echo 'successful';
    } else
    {
        echo 'nope ' . $statement->error;
    }

    $statement->close();
    $connection->close();
}

?>
