#!/bin/bash

Title[1]="Ver usuarios"
Title[2]="Ver usuario"
Title[3]="Buscar usuarios por nombre"
Title[4]="Crear usuario"
Title[5]="Actualizar usuario"
Title[6]="Eliminar usuario"
Title[7]="Ver tareas"
Title[8]="Ver tarea"
Title[9]="Buscar tareas por nombre"
Title[10]="Crear tarea"
Title[11]="Actualizar tarea"
Title[12]="Eliminar tarea"

i=0

echo "## MODO DE USO:"
echo
echo

while read -r line; do
    let "i=i+1"
    [[ $line = \#* ]] && continue
    echo "### ${Title[$i]}:"
    echo "\`\`\`"
    echo "\$ $line"
    echo "\`\`\`"
    echo
    echo "Respuesta:"
    echo "\`\`\`"
    $line
    echo
    echo "\`\`\`"
    echo
    echo
done < "curlCmds.txt"

exit
