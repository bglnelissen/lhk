#!/bin/bash
# b. nelissen

# easy GIT upload script for KoekoekPi

function runAndReturnStatus {
    "$@"
    echo
    echo "${@}..."
    echo
    local status=$?
    if [ $status -ne 0 ]; then
        echo "error with $1" >&2
    fi
    return $status
}

commitmessage="$@"

while [[ "" == "$commitmessage" ]]; do
  read -p "Commit message: " commitmessage
done


runAndReturnStatus git status
runAndReturnStatus git add *
runAndReturnStatus git commit -m "$commitmessage"
runAndReturnStatus git push pi master
