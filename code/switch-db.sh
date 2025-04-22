#!/bin/bash

# Script to switch between Docker and local MySQL

# Check if .env.local exists
if [ ! -f .env.local ]; then
    echo "Creating .env.local file..."
    echo "# This file is used to override environment variables for your local environment" > .env.local
    echo "# It should not be committed to version control" >> .env.local
    echo "" >> .env.local
    echo "# Uncomment the line below to use Docker MySQL" >> .env.local
    echo "# DATABASE_HOST=mysql" >> .env.local
    echo "" >> .env.local
    echo "# Uncomment the line below to use local MySQL" >> .env.local
    echo "DATABASE_HOST=127.0.0.1" >> .env.local
fi

# Check if we're switching to Docker or local
if [ "$1" == "docker" ]; then
    echo "Switching to Docker MySQL..."
    sed -i 's/^DATABASE_HOST=127.0.0.1/# DATABASE_HOST=127.0.0.1/' .env.local
    sed -i 's/^# DATABASE_HOST=mysql/DATABASE_HOST=mysql/' .env.local
    echo "Switched to Docker MySQL. Please restart your application."
elif [ "$1" == "local" ]; then
    echo "Switching to local MySQL..."
    sed -i 's/^DATABASE_HOST=mysql/# DATABASE_HOST=mysql/' .env.local
    sed -i 's/^# DATABASE_HOST=127.0.0.1/DATABASE_HOST=127.0.0.1/' .env.local
    echo "Switched to local MySQL. Please restart your application."
else
    echo "Usage: $0 [docker|local]"
    echo "  docker - Switch to Docker MySQL"
    echo "  local  - Switch to local MySQL"
fi 