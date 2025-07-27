set -a && source .env && set +a
lftp -e "mirror --newer-than=now-5minutes -R $LOCAL_DIR $REMOTE_DIR --exclude vendor --exclude .git" -u $FTP_USER,$FTP_PASSWORD $FTP_HOST 
