# Sockets (TCP|UDP)/IP

## Sockets

- Un socket est un canal de communication entre deux appareils connectés au réeau
- Il au minimum une adresse IP et deux numéros de ports. Souvent, on aura deux adrersses IP différentes et deux ports différents.
- Le TPC/IP n'est pas obligatoire mais nous allons travailler en IP et TCP ou UDP.
- Les sockets peuvent fonctionner en TCP ou en UDP.
- Ils peuvent être chiffrés (SSL/TLS) ou non (données claires).
- Ils peuvent transporter n'importe quel type de données : binaire, texte ascii/utf8/texte japonais/images/documents...

## Commande `netcat`

La commande `netcat` permet d'ouvrir des sockets et d'établir des communications.

Sous Linux, elle est disponible directement, sous Windows, il faut l'installer : `winget install Insecure.Nmap`