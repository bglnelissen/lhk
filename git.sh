#!/bin/bash
# b. nelissen

# easy GIT upload script for KoekoekPi

function runAndReturnStatus {
    "$@"
    echo
    echo "++++++++++"
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


echo $(runAndReturnStatus git status)
echo $(runAndReturnStatus git add *)
echo $(runAndReturnStatus git commit -m "$commitmessage")
echo $(runAndReturnStatus git push pi master)
