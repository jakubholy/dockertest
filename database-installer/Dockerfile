FROM opensuse
RUN zypper install -y php7 php7-mysql
COPY database_setup.php .
CMD php database_setup.php
