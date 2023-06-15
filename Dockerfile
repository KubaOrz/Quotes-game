FROM mysql:latest

COPY db/init.sql /docker-entrypoint-initdb.d/

ENV MYSQL_ROOT_PASSWORD=B9olP6_&
ENV MYSQL_DATABASE=quotes_game

EXPOSE 3306
