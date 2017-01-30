#!/bin/bash
# b. nelissen

# easy GIT upload script for KoekoekPi

function mytest {
    "$@"
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


mytest git status
mytest git add *
mytest git commit -m "$commitmessage"
mytest git push pi master
