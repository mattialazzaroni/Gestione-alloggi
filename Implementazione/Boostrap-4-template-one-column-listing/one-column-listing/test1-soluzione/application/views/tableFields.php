<div class="container">
    <h2>Gestione Tabelle</h2>
    <!-- form per aggiunta strumento -->
    <div>
        <h3>Campi della tabella Mysql</h3>
        <form action="<?php echo URL; ?>home/addFields" method="POST">
            <table>
                <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <td>Campo</td>
                    <td>Formato</td>
                    <td>Dimensione</td>
                </tr>
                </thead>
                <tbody>

				<?php for ($riga = 0; $riga < $tableNumberFields; $riga++): ?>

                    <tr>
                        <td><input type="text" name="field[]" required></td>
                        <td><select name="dataType[]">
								<?php foreach ($types as $type): ?>
                                    <option value="<?php echo $type[0] ?>"><?php echo $type[0] ?></option>
								<?php endforeach; ?>

                            </select>
                        </td>
                        <td><input type="text" name="size[]"></td>
                    </tr>

				<?php endfor; ?>
                </tbody>
            </table>
            <input type="submit" name="submit_add_table" value="Submit"/>
        </form>
    </div>
</div>


