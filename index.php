<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link type="text/css" rel="stylesheet" href="style.css">
        <script src="Spalte.js"> 
        </script>

    </head>
    <body>
        <form action="insert.php" >
            <fieldset>
                <legend>Insert:</legend>
                Tablename:
                <input type="text" name="table" value="table">
                <br>

                <fieldset>
                    <legend>Spaltennamen:</legend>

                    <div id="columns">
                        <input id="column1" type="text" name="columns[]" value="column">
                    </div>

                    <button type="button" onclick="Spalte.hinzufuegen()">hinzufügen</button>
                    <button type="button" onclick="Spalte.entfernen()">entfernen</button>
                </fieldset>

                <fieldset >
                    <legend>Werte:</legend>

                    <div id="values">
                        <input id="value1" type="text" name="values[]" value="value">
                    </div>

                </fieldset>
                <br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
        <p id="fehler"></p>

    </body>
</html>
