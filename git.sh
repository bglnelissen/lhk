#!/bin/bash
# b. nelissen

# easy GIT upload script for KoekoekPi

function exitcode {
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

# git pull
git pull pi master
if [ 0 == $? ]; then
  echo "Succes: git pull pi master"; echo "-------"; echo
else
  echo "FAIL: git pull pi master"; exit 1
fi

# git status
git status
if [ 0 == $? ]; then
  echo "Succes: git status"; echo "-------"; echo
  git add *
else
  echo "FAIL: git status"; exit 1
fi

# git add
git add
if [ 0 == $? ]; then
  echo "Succes: git add *"; echo "-------"; echo
  git commit -m "$commitmessage"
else
  echo "FAIL: git add *"; exit 1
fi

# git commit
git commit -m "$commitmessage"
if [ 0 == $? ]; then
  echo "Succes: git commit -m "$commitmessage""; echo "-------"; echo
  git push pi master
else
  echo "FAIL: git commit -m "$commitmessage""; exit 1
fi

# git push
git push pi master
if [ 0 == $? ]; then
  echo "Succes: git push pi master"; echo "-------"; echo
else
  echo "FAIL: git push pi master"; exit 1
fi
