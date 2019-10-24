# Gestione alloggi | Diario di lavoro - 24.10.2019

##### Mattia Lazzaroni

### Canobbio, 24.10.2019

## Lavori svolti

| Orario        | Lavori svolti   |
| ------------- | --------------- |
| 13:15 - 14:45 | Nel corso delle prime due ore ho riscontrato problemi con il mio account gmail nell'invio delle email a causa della sicurezza e della verifica dell'account. Avendo cercato una soluzione per più di un'ora ma senza successo, ho deciso di creare un account hotmail (email = gestionealloggi@hotmail.com e password = Password&3), in quanto Outlook non va a creare tutti i problemi relativi alla sicurezza e alla verifica dell'account. Dopo aver creato il nuovo account, andando a modificare qualche parametro nel codice, sono riuscito subito a far funzionare l'invio delle email. Questi sono i nuovi parametri funzionanti:

						    $mail->isSMTP();  
							$mail->SMTPDebug = 2;                  
							$mail->Host       = 'smtp.live.com';         
							$mail->SMTPAuth   = true;                                  
							$mail->Username   = 'gestionealloggi@hotmail.com';                   
							$mail->Password   = 'Password&3';                               
							$mail->SMTPSecure = 'tsl';    `PHPMailer::ENCRYPTION_SMTPS` also accepted
							$mail->Port       = 587;               
							$mail->setFrom('gestionealloggi@hotmail.com', 'Gestione alloggi');
							$mail->addAddress($email, $name . ' ' . $surname);     
							$mail->addReplyTo('gestionealloggi@hotmail.com', 'Gestione alloggi'); 

| Orario        | Lavori svolti   |
| ------------- | --------------- |
| 15:00 - 16:30 | Dopo la pausa invece ho lavorato sulla gestione dell'utente dal momento che clicca il link dalle email. Quando l'utente clicca il link nell'email, nel database il parametro "active" presente nella tabella "utente" viene modificato da "0" a "1" e l'utente può premere un bottone per tornare al login.  |

    

## Problemi riscontrati e soluzioni adottate
Nessun problema riscontrato.

## Punto della situazione rispetto alla pianificazione
In ritardo rispetto alla pianificazione.

## Programma di massima per la prossima giornata di lavoro
Nella prossima giornata di lavoro caricicherò il sito sul server e inizierò lo script.
