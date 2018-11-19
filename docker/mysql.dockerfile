FROM mysql:5.6.41
ENV MYSQL_ROOT_PASSWORD=password
ENV MYSQL_DATABASE=ejtechmo_trabalho_ppi
ENV MYSQL_USER=vinicius
ENV MYSQL_PASSWORD=password
COPY banco/setup.sh /mysql/setup.sh
COPY banco/setup.sql /mysql/setup.sql
RUN /mysql/setup.sh