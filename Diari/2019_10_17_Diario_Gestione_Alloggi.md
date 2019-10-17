# Gestione alloggi | Diario di lavoro - 17.10.2019

##### Mattia Lazzaroni

### Canobbio, 17.10.2019

## Lavori svolti

| Orario        | Lavori svolti   |
| ------------- | --------------- |
| 13:15 - 14:45 | Nel corso delle prime due ore ho lavorato sui messaggi personalizzati da mostrare all'utente quando completa la registrazione tramite le sessioni e ho implementato un nuovo bottone per permettere all'utente di fare logout. |
| 15:00 - 16:30 | Dopo la pausa ho inizialmente creato la pagina "check-your-email.php", che è la pagina in cui viene reindirizzato l'utente quanto completa una registrazione. Dopo aver realizzato il front-end di questa pagina, ho cominciato ad informarmi su internet per come implementare il sistema di verifica tramite email. Ho scoperto di aver bisogno di un nuovo campo nella mia tabella utente (hash). Questo è il modo in cui vado a creare l'hash che sarà sempre univoco:
```php
    hash = md5(time());
```

## Problemi riscontrati e soluzioni adottate
Nessun problema riscontrato.

## Punto della situazione rispetto alla pianificazione
In ritardo rispetto alla pianificazione.

## Programma di massima per la prossima giornata di lavoro
Nella prossima giornata di lavoro sicuramente terminerò se possibile la conferma tramite email.
