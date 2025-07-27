#!/bin/bash

# configuration/initialisation du script
SERVER_IMAGE_FILE=image.jpg
[ -f $SERVER_IMAGE_FILE ] || (echo "fichier image non trouvé" : exit)
MIME_TYPE=`file -b --mime-type ${SERVER_IMAGE_FILE}`
echo "Type mime détecté : "${MIME_TYPE}
FILE_SIZE=`stat -c %s ${SERVER_IMAGE_FILE}`
echo "La taille du fichier est : "${FILE_SIZE} octets.
HTTP_RESPONSE_FILE="image.http_response"

# en-têtes http envoyées au navigateur
printf "HTTP/1.1 200 OK\r\n" > $HTTP_RESPONSE_FILE
printf "Connection: close\r\n" >> $HTTP_RESPONSE_FILE
printf "Content-Type: "${MIME_TYPE}";\r\n" >> $HTTP_RESPONSE_FILE
printf "Content-Disposition: inline; filename=\"image.jpg\"\r\n" >> $HTTP_RESPONSE_FILE
printf "Content-Length: 12489\r\n\r\n" >> $HTTP_RESPONSE_FILE
echo "En-têtes http écrites dans le fichier :"
echo ""
cat $HTTP_RESPONSE_FILE
echo ""
ls -l $HTTP_RESPONSE_FILE

# ajout du fichier
cat $SERVER_IMAGE_FILE  >> $HTTP_RESPONSE_FILE 

echo "Le fichier ${HTTP_RESPONSE_FILE} est prêt et complet. Il contient une réponse http complète."
echo "vous pouvez comparer le fichier original et la réponse"
ls -l $SERVER_IMAGE_FILE $HTTP_RESPONSE_FILE
