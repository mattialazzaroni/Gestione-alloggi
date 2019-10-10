<div class="container">
    <h2>Gestione Tabelle</h2>
    <!-- form per aggiunta strumento -->
    <div>
        <h3>Aggiungi una tabella Mysql</h3>
        <form action="<?php echo URL; ?>home/addTable" method="POST">
            <table>
                <tr>
                    <td>
                        Nome Tabella
                    </td>
                    <td>
                        <input type="text" name="tableName" value="" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Numero Campi
                    </td>
                    <td>
                        <input type="number" name="tableNumberFields" value="" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit_add_table" value="Submit"/>
                    </td>
                </tr>
            </table>


        </form>
    </div>


</div>
