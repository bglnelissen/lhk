#!/bin/bash
# b. nelissen

# easy GIT upload script for KoekoekPi

commitmessage="$@"
echo "$commitmessage"
while [[ "" == "$commitmessage" ]]; do
  read -p "Commit message: " commitmessage
done


git status
gsexit=$?

if [ 0 != $gsexit ]; then
  echo "Problems with git, initialized?"
else
  # git should be fine
  git add * && \
  git commit -m "$commitmessage" && \
  git push pi master
fi