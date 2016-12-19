var Spalte =
        {
            anzahlSpalten: function ()
            {
                return document.getElementById('columns').childElementCount;
            }
            ,
            anzahlWerte: function () {
                return document.getElementById('values').childElementCount;
            }
            ,
            hinzufuegen:
                    function ()
                    {
                        var columnParent = document.getElementById('columns');
                        var valueParent = document.getElementById('values');

                        var input = document.createElement('input');
                        input.id = 'column' + this.anzahlSpalten();
                        input.type = 'text';
                        input.name = 'columns[]';
                        input.value = 'column' + this.anzahlSpalten();
                        document.getElementById('columns').appendChild(input);

                        var input = document.createElement('input');
                        input.id = 'value' + this.anzahlWerte();
                        input.type = 'text';
                        input.name = 'values[]';
                        input.value = 'value' + this.anzahlWerte();
                        document.getElementById('values').appendChild(input);

                        document.getElementById('fehler').innerHTML = 'Anzahl Spalten: ' + this.anzahlSpalten() + ' Anzahl Werte: ' + this.anzahlWerte();

                    },
            entfernen:
                    function ()
                    {
                        var columnParent = document.getElementById('columns');
                        var valueParent = document.getElementById('values');
                        if (this.anzahlSpalten() > 1)
                        {
                            columnParent.removeChild(columnParent.childNodes[this.anzahlSpalten()+1]);
                            valueParent.removeChild(valueParent.childNodes[this.anzahlWerte()+1]);
                        }
                        
                         document.getElementById('fehler').innerHTML = 'Anzahl Spalten: ' + this.anzahlSpalten() + ' Anzahl Werte: ' + this.anzahlWerte();
                    }

        };