#!/bin/bash

echo "## MODO DE USO:"
echo

while read -r line; do
    [[ $line = \#* ]] && continue
    echo "\`\`\`"
    echo "\$ $line"
    echo "\`\`\`"
    echo "Respuesta:"
    echo "\`\`\`"
    $line
    echo
    echo "\`\`\`"
    echo
done < "curlCmds.txt"

exit
