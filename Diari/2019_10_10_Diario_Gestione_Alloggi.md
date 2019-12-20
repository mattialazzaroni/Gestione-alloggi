# Gestione alloggi | Diario di lavoro - 10.10.2019

##### Mattia Lazzaroni

### Canobbio, 10.10.2019

## Lavori svolti

| Orario        | Lavori svolti   |
| ------------- | --------------- |
| 13:15 - 16:30 | Durante la giornata di lavoro mi sono concentrato sul login tramite gli utenti presenti nel database. Purtroppo, sono incappato in un problema che non ho ancora risolto. Il problema mi si presenta quando provo a loggarmi con un utente presente nel Database. |

## Problemi riscontrati e soluzioni adottate
Oggi ho riscontrato un problema nel seguente codice:
```php
$query = "SELECT * FROM utenti WHERE email='$email' AND password='$password'";
        #echo $query;
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['nome'] = $nome;
            $_SESSION['success'] = "Hai effettuato il login correttamente";
            header('location: index.php');
        } else {
            array_push($errors, "Combinazione email/password errata");
        }
```

L'errore è il seguente: 
Warning: mysqli_num_rows() expects parameter 1 to be mysqli_result, boolean given

Ho provato in tutti i modi a sistemarlo ma senza risultati.

## Punto della situazione rispetto alla pianificazione
In ritardo rispetto alla pianificazione.

## Programma di massima per la prossima giornata di lavoro
Nella prossima giornata di lavoro proverò a chiedere al responsabile una mano per sistemare il problema e nel caso che non riuscisse dovrò assolutamente trovare un'alternativa funzionante per il login.
