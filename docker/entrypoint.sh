#!/bin/sh
set -e

echo "Generowanie dokumentacji..."

TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")
DOCS_DIR="storage/api-docs"
TARGET_FILE="${DOCS_DIR}/${TIMESTAMP}_api-docs.json"

mkdir -p $DOCS_DIR

php artisan l5-swagger:generate
cp ${DOCS_DIR}/api-docs.json $TARGET_FILE

cp ${DOCS_DIR}/api-docs.json ${DOCS_DIR}/latest.json

exec php artisan serve --host=0.0.0.0 --port=10000