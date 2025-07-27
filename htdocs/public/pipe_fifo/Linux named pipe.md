# Pipe nommé sous Linux

## Qu'est-ce que c'est

Un pipe nommé est comme un fichier qui permet la communication inter-processus.


```bash
# Créé un pipe nommé /tmp/pipe
mkfifo /tmp/pipe 
``` 

- Deux processus A et B peuvent partager des informations via le pipe nommé
- Le processus A écrit dans le pipe   ; on ouvre et on ferme le robinet pour envoyer de l'eau dans le pipe
- Le processus B lit le pipe          ; on nettoie la voiture, on arrose le jardin

- L'algorithime du processus B est le suivant :

    ```txt
    on attend indéfiniment des données - que l'eau arrive, que quelqu'un ouvre le robinet
       à réception des données           
         les données sont sorties du pipe, elle ne sont plus disponibles         
         le processus traite les données - on consomme l'eau
    ```
 
- L'algorithme du processus A ressemble, d'une manière simplifiée, à ceci :
 
    ```txt
    1. le kärcher ou le filtre à eau est vide
    2. à ouverture du robinet, on enclenche le compresseur/le moteur haute pression/le filtre
    3. l'eau compressée ou filtrée sort
    ```

    ```txt
    le linebuffer est vide 
    sur appui d'une touche, on ajoute le caractère correspondant au linebuffer
    sur appui de la touche entrée, on envoie le linebuffer au pipe
    ```

Image <https://commons.wikimedia.org/wiki/User:Frosch74#/media/File:Named_pipe_using_mkfifo.png>

- la différence avec un pipe simple

  - un pipe simple (commande1) | (comande2) n'envoie les données qu'une seule fois, la commande1 se termine et envoie les données à la commande 2
  - un pipe nommé est dynamique, la commande1 peut envoyer des données en continue à la commande2
  - exemple

    ```bash
    # fenêtre 1
    mkfifo  /tmp/pipe         # création du pipe
    tail -f /tmp/pipe         # traitement
    # fenêtre 2
    cat  - | tee > /tmp/pipe  # envoi des données dans le pipe
    ```
 



