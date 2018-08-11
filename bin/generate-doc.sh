#!/bin/bash

source bin/endpoints.sh

echo -e "# USE:\n\n"

for i in {1..15}
do
    echo "## ${ttl[$i]}:"
    echo
    echo "Request:"
    echo "\`\`\`"
    echo "\$ ${cmd[$i]}"
    echo "\`\`\`"
    echo
    echo "Response:"
    echo "\`\`\`"
    ${cmd[$i]}
    echo
    echo "\`\`\`"
    echo
    echo
done
