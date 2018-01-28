#!/bin/bash

source bin/endpoints.sh

echo -e "# MODO DE USO:\n\n"

for i in {1..15}
do
    echo "## ${ttl[$i]}:"
    echo
    echo "Petición:"
    echo "\`\`\`"
    echo "\$ ${cmd[$i]}"
    echo "\`\`\`"
    echo
    echo "Respuesta:"
    echo "\`\`\`"
    ${cmd[$i]}
    echo
    echo "\`\`\`"
    echo
    echo
done
