# Gestione alloggi | Diario di lavoro - 15.10.2019

##### Mattia Lazzaroni

### Canobbio, 15.10.2019

## Lavori svolti

| Orario        | Lavori svolti   |
| ------------- | --------------- |
| 13:15 - 14:45 | Oggi nel corso delle due ore ho lavorato sul login. Inizialmente ho finito di adattare il login e la registrazione con PDO, successivamente ho lavorato per sistemare alcuni problemi che mi impedivano di loggarmi correttamente. Ad esempio nella query per accedere alle informazioni della tabella del Database, andavo a scrivere "utenti" per il nome della tabella, al posto di "utente". Questo mi scatenava un errore che non riuscivo a sistemare a ci ho messo un po' a capire. Inoltre andavo a limitare la lunghezza dell password nel database ad un varchar(30), in questo modo la hash della password non veniva inserita completamente e al login risultava il problema che le password non coincidevano. Ho quindi messo il campo della password a varchar(255) per non aver problemi. |


## Problemi riscontrati e soluzioni adottate
Nessun problema riscontrato.

## Punto della situazione rispetto alla pianificazione
In ritardo rispetto alla pianificazione.

## Programma di massima per la prossima giornata di lavoro
Nella prossima giornata di lavoro sicuramente dovrò aggiungere la conferma della registrazione tramite email e comincerò la pagina dell'amministratore.
