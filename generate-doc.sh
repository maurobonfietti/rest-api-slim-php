#!/bin/bash

source endpoints.sh

echo -e "## MODO DE USO:\n\n"

for i in {1..12}
do
    echo "### ${ttl[$i]}:"
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
