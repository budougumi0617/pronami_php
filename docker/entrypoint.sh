#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
  set -- apache2-foreground "$@"
fi

if [ "$1" = "apache2-foreground" ]; then
  exec "$@"
else
  # use www-data for cli
  echo "gosu user to www-data"
  exec gosu www-data "$@"
fi
