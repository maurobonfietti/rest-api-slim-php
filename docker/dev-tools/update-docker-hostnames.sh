#!/bin/bash

ETC_HOSTS=/etc/hosts

declare -a IPS=(
"`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' rest-api-slim-php-nginx-container`"
)

declare -a HOSTNAMES=(
"rest-api-slim-php.docker.local"
)

removehosts() {
    for i in "${!HOSTNAMES[@]}"
        do
            HOSTNAME="${HOSTNAMES[$i]}"
            echo "removing host";
            if [ -n "$(grep $HOSTNAME /etc/hosts)" ]
                then
                    echo "$HOSTNAME Found in your $ETC_HOSTS, Removing now...";
                    sudo sed -i".bak" "/$HOSTNAME/d" $ETC_HOSTS
                else
                    echo "$HOSTNAME was not found in your $ETC_HOSTS";
            fi
        done
}

addhosts() {
    removehosts
    for i in "${!HOSTNAMES[@]}"
        do
        if [ -n "${HOSTNAMES[$i]}" ] && [ -n "${IPS[$i]}" ]
            then
                HOSTNAME="${HOSTNAMES[$i]}"
                IP="${IPS[$i]}"
                echo "adding host";
                HOSTS_LINE="$IP\t$HOSTNAME"
                if [ -n "$(grep $HOSTNAME /etc/hosts)" ]
                    then
                        echo "$HOSTNAME already exists : $(grep $HOSTNAME $ETC_HOSTS)"
                    else
                        echo "Adding $HOSTNAME to your $ETC_HOSTS";
                        sudo -- sh -c -e "echo '$HOSTS_LINE' >> /etc/hosts";
                        if [ -n "$(grep $HOSTNAME /etc/hosts)" ]
                            then
                                echo "$HOSTNAME was added succesfully \n $(grep $HOSTNAME /etc/hosts)";
                            else
                                echo "Failed to Add $HOSTNAME, Try again!";
                        fi
                fi
        fi
    done
}

addhosts
$@
